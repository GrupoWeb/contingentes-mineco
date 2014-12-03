<?php
class solicitudesemisionController extends crudController {

	public function __construct() {
		Crud::setExport(false);
		Crud::setSearch(false);
		Crud::setTitulo('Solicitudes pendientes - Emisión');
		Crud::setTabla('solicitudesemision');
		Crud::setTablaId('solicitudemisionid');
		
		Crud::setLeftJoin('authusuarios AS u', 'solicitudesemision.usuarioid', '=', 'u.usuarioid');
		Crud::setLeftJoin('periodos AS p', 'solicitudesemision.periodoid', '=', 'p.periodoid');
		Crud::setLeftJoin('contingentes AS c', 'p.contingenteid', '=', 'c.contingenteid');
		Crud::setLeftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid');
		Crud::setLeftJoin('productos AS d', 'c.productoid', '=', 'd.productoid');

		Crud::setWhere('estado', 'Pendiente');

		Crud::setCampo(array('nombre'=>'Usuario','campo'=>'u.nombre'));
		Crud::setCampo(array('nombre'=>'Periodo','campo'=>'p.nombre'));
		Crud::setCampo(array('nombre'=>'Tratado','campo'=>'t.nombre'));
		Crud::setCampo(array('nombre'=>'Producto','campo'=>'d.nombre','class'=>'text-right'));
		Crud::setCampo(array('nombre'=>'Monto Solicitado','campo'=>'solicitado','tipo'=>'numeric','class'=>'text-right'));
		Crud::setCampo(array('nombre'=>'Fecha de solicitud','campo'=>'solicitudesemision.created_at', 'tipo'=>'datetime','class'=>'text-right'));
		
		Crud::setPermisos(Cancerbero::tienePermisosCrud('solicitudespendientes.emision'));
	}

	public function edit($id) {
		$solicitud 			= Emisionpendiente::getSolicitudPendiente(Crypt::decrypt($id));
		$requerimientos = Solicitudemisionrequerimiento::getEmisionRequerimientos(Crypt::decrypt($id));

		return View::make('solicitudespendientes/emisiones')
			->with('solicitud',$solicitud)
			->with('requerimientos',$requerimientos);
	}

	public function store() {
		$elID = Crypt::decrypt(Input::get('id'));

		if(Input::has('btnAutorizar')) {
			$cantidad   = Input::get('txCanidad');
			$comentario = Input::get('txObservaciones');
			
			//TRANSACTION ===
			$emision                = Emisionpendiente::find($elID);
			$emision->emitido       = $cantidad;
			$emision->observaciones = Input::get('txObservaciones');
			$emision->estado        = 'Aprobada';
			$result                 = $emision->save();

			$certificado                     = new Certificado;
			$certificado->tratado            = 'Nombre tratado';
			$certificado->usuarioid          = $emision->usuarioid;
			$certificado->nombre             = 'Erick Marroquin';
			$certificado->direccion          = '4 ave. 11-28 z. 14';
			$certificado->nit                = '4530406-8';
			$certificado->telefono           = '57661044';
			$certificado->volumen            = $cantidad;
			$certificado->volumenletras      = 'Un mil dos cientos';
			$certificado->fraccion           = '0200.10.10 - Otros';
			$certificado->paisprocedencia    = 'E.E.U.U.';
			$certificado->tratadodescripcion = 'Segun el diario oficial 2006...';
			$certificado->fecha              = date_create();
			$certificado->fechavencimiento   = '2014-12-31';
			$certificado->save();

			$movimiento                = new Movimiento;
			$movimiento->periodoid     = $emision->periodoid;
			$movimiento->usuarioid     = $emision->usuarioid;
			$movimiento->certificadoid = $certificado->id;
			$movimiento->cantidad      = ($cantidad * -1);
			$movimiento->comentario    = $comentario;
			$result2                   = $movimiento->save();


			//====

			if($result && $result2) {
				$usuario = Authusuario::find($emision->usuarioid);
				$email   = $usuario->email;

				Session::flash('type','success');
				Session::flash('message','La solicitud de inscripción fue procesada correctamente');

				Mail::send('emails/solicitudemisionresultado', array(
					'nombre'        => $usuario->nombre,
					'fecha'         => $emision->created_at,
					'url'           => url('c/'.Crypt::encrypt($certificado->id)),
					'estado'        => 'Aprobada',
					'observaciones' => Input::get('txObservaciones')), function($msg) use ($email){
		       	$msg->to($email)->subject('Solicitud de Emisión DACE - MINECO');
				});
			}
			else {
				Session::flash('type','warning');
				Session::flash('message','Ocurrió un error al intentar autorizar, intente de nuevo.');
			}
		}
		else {
			$emision                = Emisionpendiente::find($elID);
			$emision->observaciones = Input::get('txObservaciones');
			$emision->estado        = 'Rechazada';
			$result                 = $emision->save();

			if($result) {
				Session::flash('type','success');
				Session::flash('message','La solicitud de inscripción fue rechazada');

				$usuario = Authusuario::find($emision->usuarioid);
				$email   = $usuario->email;
				Mail::send('emails/solicitudemisionresultado', array(
					'nombre'        => $usuario->nombre,
					'fecha'         => $emision->created_at,
					'estado'        => 'Rechazada',
					'observaciones' => Input::get('txObservaciones')), function($msg) use ($email){
		       	$msg->to($email)->subject('Solicitud de Emisión DACE - MINECO');
				});
			}
			else {
				Session::flash('type','warning');
				Session::flash('message','Ocurrió un error al intentar rechazar, intente de nuevo.');
			}
		}
		
		return Redirect::route('solicitudespendientes.emision.index');
	}
}