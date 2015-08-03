<?php

class solicitudactualizacionController extends crudController {
	
	public function __construct() {
		Crud::setExport(false);
		Crud::setSearch(false);
		Crud::setTitulo('Solicitudes pendientes - Actualización');
		Crud::setTabla('solicitudactualizacion');
		Crud::setTablaId('actualizacionid');

		Crud::setWhere('estado', 'Pendiente');

		Crud::setLeftJoin('authusuarios AS u', 'solicitudactualizacion.usuarioid', '=', 'u.usuarioid');
		Crud::setLeftJoin('empresas AS e', 'solicitudactualizacion.empresaid', '=', 'e.empresaid');

		Crud::setCampo(array('nombre'=>'Usuarios','campo'=>'u.nombre'));
		Crud::setCampo(array('nombre'=>'Empresa','campo'=>'e.razonsocial'));
		Crud::setCampo(array('nombre'=>'NIT','campo'=>'e.nit'));
		Crud::setCampo(array('nombre'=>'fecha','campo'=>'solicitudactualizacion.created_at','tipo'=>'datetime'));

		Crud::setPermisos(Cancerbero::tienePermisosCrud('solicitudespendientes.actualizacion'));
	}

	public function edit($id) {
		$id        = Crypt::decrypt($id);
		$solicitud = Solictudactualizacion::find($id);

		return View::make('solicitudespendientes.actualizacion')
			->with('solicitud', $solicitud)
			->with('documentos', Solictudactualizacionarchivo::getArchivosActualizacion($id))
			->with('empresa', Empresa::find($solicitud->empresaid));
	}

	public function store() {
		$id        = Crypt::decrypt(Input::get('id'));
		$solicitud = Solictudactualizacion::find($id);

		if(Input::has('btnAutorizar')) {
			$empresa = DB::transaction(function() use($solicitud) {
				$solicitud->estado        = 'Aprobada';
				$solicitud->observaciones = Input::get('txObservaciones');
				$solicitud->save();

				$empresa                          = Empresa::find($solicitud->empresaid);
				$empresa->propietario             = $solicitud->propietario;
				$empresa->domiciliofiscal         = $solicitud->domiciliofiscal;
				$empresa->domiciliocomercial      = $solicitud->domiciliocomercial;
				$empresa->direccionnotificaciones = $solicitud->direccionnotificaciones;
				$empresa->telefono                = $solicitud->telefono;
				$empresa->fax                     = $solicitud->fax;
				$empresa->encargadoimportaciones  = $solicitud->encargadoimportaciones;
				$empresa->codigovupe              = $solicitud->codigovupe;
				$empresa->save();

				return $empresa;
			});

			if($empresa) {
				Session::flash('message', 'Solicitud de actualización procesada exitosamente.');
				Session::flash('type', 'success');

				//ENVIAR CORREO!!!!
				$admins   = Usuario::listAdminEmails();
				$usuario  = Authusuario::find($solicitud->usuarioid);
				$empresas = Usuario::listEmpresaEmails($solicitud->empresaid, $solicitud->usuarioid);
				$email    = $usuario->email;

				try {
					Mail::send('emails/solicitudactualizacionresultado', array(
						'nombre'        => $usuario->nombre,
						'empresa'       => $empresa->razonsocial,
						'estado'        => 'Aprobada',
						'observaciones' => Input::get('txObservaciones')), function($msg) use ($email, $admins, $empresas){
			       	$msg->to($email)->subject('Solicitud de Actualización DACE - MINECO');
			       	$msg->cc($empresas);
			       	$msg->bcc($admins);
					});
				} catch (Exception $e) {}
			}

			else {
				Session::flash('message', 'Ocurrió un error al intentar autorizar, intente de nuevo.');
				Session::flash('type', 'danger');
			}
		}

		else {
			$solicitud->estado        = 'Rechazada';
			$solicitud->observaciones = Input::get('txObservaciones');
			$solicitud->save();

			Session::flash('message', 'Solicitud de actualización procesada exitosamente.');
			Session::flash('type', 'success');

			//ENVIAR CORREO!!!
			$admins   = Usuario::listAdminEmails();
			$usuario  = Authusuario::find($solicitud->usuarioid);
			$empresas = Usuario::listEmpresaEmails($solicitud->empresaid, $solicitud->usuarioid);
			$email    = $usuario->email;
			$empresa  = Empresa::getInfoEmpresa($solicitud->empresaid);

			try {
					Mail::send('emails/solicitudactualizacionresultado', array(
						'nombre'        => $usuario->nombre,
						'empresa'       => $empresa->razonsocial,
						'estado'        => 'Aprobada',
						'observaciones' => Input::get('txObservaciones')), function($msg) use ($email, $admins, $empresas){
			       	$msg->to($email)->subject('Solicitud de Actualización DACE - MINECO');
			       	$msg->cc($empresas);
			       	$msg->bcc($admins);
					});
				} catch (Exception $e) {}
		}

		return Redirect::to('solicitudespendientes/actualizacion');
	}
}
