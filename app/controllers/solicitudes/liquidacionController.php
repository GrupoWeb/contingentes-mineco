<?php

class liquidacionController extends crudController {
	
	public function __construct() {
		//funcion exporta .xls
		Crud::setExport(false);
		//titulo catalogo
		Crud::setTitulo('Solicitudes pendientes - Liquidación');
		
		//conexion db a la tabla
		Crud::setTabla('solicitudesliquidacion');
		Crud::setTablaId('solicitudliquidacionid');

		//condicion db
		Crud::setWhere('estado', 'Pendiente');

		//relacion entre tablas
		Crud::setLeftJoin('authusuarios AS u', 'solicitudesliquidacion.usuarioid', '=', 'u.usuarioid');
		Crud::setLeftJoin('empresas AS e', 'u.empresaid', '=', 'e.empresaid');
		Crud::setLeftJoin('certificados AS c', 'solicitudesliquidacion.certificadoid', '=', 'c.certificadoid');

		//definicion de campos con datos de la conexion y relacion de tabla
		Crud::setCampo(array('nombre'=>'Usuarios','campo'=>'u.nombre'));
		Crud::setCampo(array('nombre'=>'Empresa','campo'=>'e.razonsocial'));
		Crud::setCampo(array('nombre'=>'Certificado','campo'=>'c.numerocertificado'));
		Crud::setCampo(array('nombre'=>'DUA','campo'=>'solicitudesliquidacion.dua'));
		Crud::setCampo(array('nombre'=>'Monto Real','campo'=>'solicitudesliquidacion.real'));
		Crud::setCampo(array('nombre'=>'CIF','campo'=>'solicitudesliquidacion.cif'));		

		//permisos cancerbero
		Crud::setPermisos(Cancerbero::tienePermisosCrud('solicitudespendientes.liquidacion'));
	}

	public function edit($id) {
		try {
			//captura id de la solicitud
			$solicitudid = Crypt::decrypt($id);
		} catch (Exception $e) {
			//muestra mensaje si exite error
			Session::flash('message', 'Solicitud invalida');
	    Session::flash('type', 'danger');
	    return Redirect::to('solicitudespendientes/liquidacion');
		}

		//consulta en db segun id
		$solicitud = Solicitudliquidacion::getSolicitud($solicitudid);

		//retorna datos a la vista
		return View::make('solicitudespendientes.liquidaciones', ['solicitud'=>$solicitud]);
	}

	public function store() {
		try {
			//asigna valor de hidden
			$solicitudid = Crypt::decrypt(Input::get('id'));
		} catch (Exception $e) {
			//muestra mensaje si existe error
			Session::flash('message', 'Solicitud invalida');
	    Session::flash('type', 'danger');
	    //retorna ala vista
	    return Redirect::to('solicitudespendientes/liquidacion');
		}

		//asigna valores del formulario
		$estado        = (Input::has('btnAutorizar') ? 'Aprobada' : 'Rechazada');
		$observaciones = Input::get('txObservaciones');

		//inserta datos al db
		$solicitud = DB::transaction(function() use ($solicitudid, $estado, $observaciones) {
			$solicitud                       = Solicitudliquidacion::find($solicitudid);
			$solicitud->estado               = $estado;
			$solicitud->observaciones        = $observaciones;
			$solicitud->save();

			if($estado == 'Aprobada') {
				$certificado                   = Certificado::find($solicitud->certificadoid);
				$certificado->dua              = $solicitud->dua;
				$certificado->real             = $solicitud->real;
				$certificado->cif              = $solicitud->cif;
				$certificado->fechaliquidacion = $solicitud->fechaliquidacion;
				$certificado->save();
			}

			return $solicitud;
		});

		if($solicitud) {
			//enviar correo
			$usuario  = Authusuario::find($solicitud->usuarioid);
			$empresa  = Empresa::find($usuario->empresaid);
			$empresas = Usuario::listEmpresaEmails($usuario->empresaid, $usuario->usuarioid);
			$admins   = Usuario::listAdminEmails();

			try {
				Mail::send('emails.solicitudliquidacionresultado', array(
					'empresa'       => $empresa->razonsocial,
					'usuario'       => $usuario->nombre,
					'estado'        => $estado,
					'observaciones' => $observaciones), function($msg) use ($usuario, $admins, $empresas){
		       	$msg->to($usuario->email)->subject('Solicitud de Liquidación DACE - MINECO');
		       	$msg->cc($empresas);
		       	$msg->bcc($admins);
				});
			} catch (Exception $e) {}

			Session::flash('message', 'Solicitud procesada exitosamente');
	    Session::flash('type', 'success');
	  }

	  else {
	  	Session::flash('message', 'Error al procesar la solicitud');
	    Session::flash('type', 'danger');
	  }

    return Redirect::to('solicitudespendientes/liquidacion');
	}
}
