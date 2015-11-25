<?php

class certificadosController extends Controller {

	public function index() {
		return View::make('certificados.filtros')
      ->with('titulo', 'Certificados')
      ->with('tratados', Tratado::getTratados())
      ->with('filters', array('tratados', 'contingentes', 'periodos', 'empresas', 'fechaini', 'fechafin'))
      ->with('todos',['tratados']);
	}

	public function getcontingentes($id) {
    try {
      $id = Crypt::decrypt($id);      
    } catch (\Exception $e) {
      return "Tratado inválido";
    }

		$empresaid = Auth::user()->empresaid;

    if ($empresaid) 
      $contingentes = Contingente::getContTratadoEmpresa($id, $empresaid);
    else
      $contingentes = Contingente::getContTratado($id);

		return View::make('partials.certificados.contingentes')
      ->with('contingentes', $contingentes)
      ->with('nombre', 'contingenteid')
      ->with('id', 'contingenteid');
	}

	public function getperiodos($id) {
		return View::make('partials.certificados.periodos')
      ->with('periodos', Periodo::getPeriodosContingente(Crypt::decrypt($id)))
      ->with('nombre', 'periodoid')
      ->with('id', 'periodoid');
	}

	public function getempresas($id) {
		$id        = Crypt::decrypt($id);
		$empresaid = Auth::user()->empresaid;

		return View::make('partials.certificados.empresas')
      ->with('empresas', Empresa::getEmpresasPeriodo($id, $empresaid))
      ->with('nombre', 'empresaid')
      ->with('id', 'empresaid');
	}

  public function store() {
    try {
      $tratadoid     = Crypt::decrypt(Input::get('tratadoid'));
      $contingenteid = Crypt::decrypt(Input::get('contingenteid'));
      $periodoid     = Crypt::decrypt(Input::get('periodoid'));
      $empresaid     = Crypt::decrypt(Input::get('empresaid'));    
    } catch (\Exception $e) {
      return View::make('cancerbero::error')
        ->with('mensaje','Tratado, período, contingente o empresa inválidos.');
    }
  
    $fechaini      = Components::fechaHumanoAMySql(Input::get('fechaini')).' 00:00';
    $fechafin      = Components::fechaHumanoAMySql(Input::get('fechafin')).' 23:59';  

    $certificados  = Certificado::getCertificados($tratadoid, $contingenteid, $periodoid, $empresaid, $fechaini, $fechafin);
    $tmp           = array();
    foreach($certificados as $certificado) {
      $tmp[$certificado->numerocertificado] = array(
        'fecha'         => $certificado->fecha,
        'nombre'        => $certificado->nombre,
        'volumen'       => $certificado->volumen,
        'liquidado'     => $certificado->liquidado,
        'anulado'       => $certificado->anulado,
        'comentario'    => $certificado->comentario,
        'certificadoid' => $certificado->certificadoid
      );
    }

    
    return View::make('certificados.listado')
      ->with('certificados', $tmp);
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
    PDF::setPrintFooter(false);

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

      return Redirect::to('certificados');
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
}