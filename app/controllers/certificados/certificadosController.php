<?php
class certificadosController extends crudController {

	public function __construct() {
		Crud::setExport(false);
		Crud::setTitulo('Certificados');
		Crud::setTabla('certificados');
		Crud::setTablaId('certificadoid');
		Crud::setLeftJoin('authusuarios AS u', 'certificados.usuarioid', '=', 'u.usuarioid');

		$tselected = Session::get('tselected');
		if($tselected <> 0) {
			

			Crud::setWhereRaw("(SELECT 
			    c.tratadoid 
			  FROM movimientos AS m 
			  LEFT JOIN periodos AS p ON m.periodoid = p.periodoid 
			  LEFT JOIN contingentes AS c ON p.contingenteid = c.contingenteid
			  WHERE m.certificadoid = certificados.certificadoid
			  LIMIT 1) = ".$tselected);

			Crud::setTitulo('Certificados - '.Tratado::getNombre($tselected));
		}

		if(in_array(Auth::user()->rolid, Config::get('contingentes.rolempresa'))) {
			Crud::setWhere('u.empresaid', Auth::user()->empresaid);
		}

		Crud::setCampo(array('nombre'=>'No.','campo'=>'certificados.numerocertificado'));
		Crud::setCampo(array('nombre'=>'Fecha','campo'=>'certificados.fecha','tipo'=>'date'));
		Crud::setCampo(array('nombre'=>'Nombre','campo'=>'certificados.nombre'));
		Crud::setCampo(array('nombre'=>'Volúmen','campo'=>'certificados.volumen', 'class'=>'text-right'));
		Crud::setCampo(array('nombre'=>'Liquidado','campo'=>'(IF(dua IS NULL, 0, 1))','tipo'=>'bool'));
		Crud::setCampo(array('nombre'=>'Anulado','campo'=>'anulado','tipo'=>'bool'));

		Crud::setOrderBy(array('columna'=>1,'direccion'=>'desc'));

	 	if(!in_array(Auth::user()->rolid, Config::get('contingentes.rolempresa'))) {
	 		Crud::setBotonExtra(array('url'=>'c/{id}','icon'=>'fa fa-file-pdf-o','titulo'=>'Generar','class'=>'primary', 'target'=>'_blank'));
		 	Crud::setBotonExtra(array('url'=>'certificados/liquidar/{id}','icon'=>'fa fa-check-square ','titulo'=>'Liquidar','class'=>'success'));
		 	Crud::setBotonExtra(array('url'=>'certificados/anular/{id}','icon'=>'fa fa-minus-square-o','titulo'=>'Anular','class'=>'danger'));
		}

		Crud::setPermisos(array('edit'=>false,'add'=>false,'delete'=>false));
	}

	public function generarPDF($id) {
		try {
			$id  = Crypt::decrypt($id);
		} catch (Exception $e) {
			return "El certificado no es valido";
		}
		
		$datos = Certificado::getCertificado($id);

		if($datos->anulado == 1)
			return "El certificado ha sido anulado";
	
		if(!$datos->certificado || $datos->certificado == '' || !$datos->firma || $datos->firma == '')
			return "Imposible generar el certificado debido a faltas de firma.";

		PDF::SetTitle('Certificado');
		PDF::AddPage();
		PDF::setLeftMargin(20);

		$certificate = $datos->certificado;
		PDF::SetSignature($certificate, $certificate, 'cservice');

		$html = View::make($datos->vista)
			->with('datos', $datos);

		PDF::writeHTML($html, true, false, true, false, '');

		/*PDF::Image('@' . $datos->firma, 105,220,70,35,'JPG','','N');
		PDF::line(80,245, 200,245);
		PDF::writeHTMLCell(0,0, 80, 250, $datos->nombrecompleto . '<br>' . $datos->puesto, 0, 1, 0, true,'C', true);
		PDF::write2DBarcode(url('c/' . $id),'QRCODE,M',10,233,25,25);*/

		//=== WATERMARK ===
		/*PDF::setPage( 1 );
		$myPageWidth  = PDF::getPageWidth();
		$myPageHeight = PDF::getPageHeight();
		
		$myX = ( $myPageWidth / 2 ) - 75;
		$myY = ( $myPageHeight / 2 ) + 50;
		
		PDF::SetAlpha(0.09);
		
		PDF::StartTransform();
		PDF::Rotate(45, $myX, $myY);
		PDF::SetFont("courier", "", 45);
		PDF::Text($myX, $myY,"CERTIFICADO NO VALIDO"); 
		PDF::StopTransform();
		PDF::SetAlpha(1);*/
		//========

		PDF::Output('certificado.pdf');
	}

	public function anular($id) {
		$certificado = Certificado::find(Crypt::decrypt($id));
		
		if($certificado->dua <> '') {
			Session::flash('message', 'No es posible anular un certificado liquidado');
			Session::flash('type', 'danger');

			return Redirect::to('certificados');
		}

		if($certificado->anulado == 1) {
			Session::flash('message', 'El certificado ya se encuentra anulado');
			Session::flash('type', 'warning');
		}

		return View::make('certificados.anulaciones')
				->with('certificado', $id);
	}

	public function procesaranulacion(){
		$certificado          = Certificado::find(Crypt::decrypt(Input::get('certificado')));
		$certificado->anulado = 1;
		$certificado->save();

		$movimientop = Movimiento::where('certificadoid', $certificado->certificadoid)->first();

		if(!$movimientop) {
			Session::flash('message', 'El certificado no existe en el sistema');
			Session::flash('type', 'danger');

			return Redirect::to('certificados');
		}

		$movimiento                   = new Movimiento;
		$movimiento->periodoid        = $movimientop->periodoid;
		$movimiento->usuarioid        = $certificado->usuarioid;
		$movimiento->certificadoid    = $certificado->certificadoid;
		$movimiento->cantidad         = $certificado->volumen;
		$movimiento->comentario       = 'Certificado '.number_format($certificado->certificadoid).' anulado por: '.Input::get('txMotivo');
		$movimiento->tipomovimientoid = DB::table('tiposmovimiento')->where('nombre', 'Certificado')->pluck('tipomovimientoid');
		$movimiento->created_by       = Auth::id();
		$movimiento->save();

		Session::flash('message', 'Certificado anulado exitosamente');
		Session::flash('type', 'success');

		return Redirect::to('certificados');
	}

	public function liquidar($id) {	
		$certificado = Certificado::find(Crypt::decrypt($id));

		if($certificado->anulado == 1) {
			Session::flash('message', 'No es posible liquidar un certificado anulado');
			Session::flash('type', 'danger');

			return Redirect::to('certificados');
		}

		if($certificado->dua <> '') {
			Session::flash('message', 'No es posible liquidar un certificado ya liquidado');
			Session::flash('type', 'danger');

			return Redirect::to('certificados');
		}

		return View::make('certificados.liquidaciones')
			->with('certificado', $id);
	}

	public function procesarliquidacion($id) {
		$certificado                   = Certificado::find(Crypt::decrypt($id));
		$certificado->dua              = Input::get('txDua');
		$certificado->real             = Input::get('txCantidad');
		$certificado->cif              = Input::get('txCIF');
		$certificado->fechaliquidacion = Components::fechaHumanoAMysql(Input::get('txFecha'));
		$certificado->save();

		Session::flash('message', 'Certificado liquidado exitosamente');
		Session::flash('type', 'warning');

		return Redirect::to('certificados');
	}
}