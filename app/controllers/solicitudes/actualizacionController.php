<?php

class actualizacionController extends crudController {
	
	public function index() {
		//verifica usuario
		if (!Auth::user()->empresaid) {
			//muestra mensaje
			Session::flash('message', 'Este usuario no tiene empresa asociada.');
			Session::flash('type', 'danger');

			//retorna a la vista
			return Redirect::to('inicio');
		}

		//consulta en db usuario
		$pendiente = Solictudactualizacion::getPendientes(Auth::user()->empresaid);

		//condiciona la consulta
		if($pendiente <> null) {			
			Session::flash('message', 'La empresa tiene actualizaciones de datos pendientes. Debe esperar a que se autorice/rechace');
			Session::flash('type', 'danger');

			//retorna a la vista
			return Redirect::to('inicio');
		}

		else {
			//retorna datos a la vista
			return View::make('empresas.edit')
				->with('data', Empresa::getInfoEmpresa(Auth::user()->empresaid));
		}
	}

	public function store() {
		//inserta datos en db
		DB::transaction(function() {
			$ac                          = new Solictudactualizacion;
			$ac->empresaid               = Auth::user()->empresaid;
			$ac->usuarioid               = Auth::id();
			$ac->propietario             = Input::get('txPropietario');
			$ac->domiciliofiscal         = Input::get('txDomicilioFiscal');
			$ac->domiciliocomercial      = Input::get('txDomicilioComercial');
			$ac->direccionnotificaciones = Input::get('txDireccionNotificaciones');
			$ac->telefono                = Input::get('txTelefono');
			$ac->fax                     = Input::get('txFax');
			$ac->encargadoimportaciones  = Input::get('txEncargadoImportaciones');
			$ac->codigovupe              = Input::get('txVUPE');
			$ac->save();

			foreach (Input::file('adjuntos') as $adjunto) { 
	    	if ($adjunto) {
					$nombre = date('Ymdhis') . mt_rand(1, 1000) . '.' . strtolower($adjunto->getClientOriginalExtension());
					$res    = $adjunto->move(public_path() . '/archivos/actualizaciones/'.$ac->actualizacionid, $nombre);
					
					$acr                  = new Solictudactualizacionarchivo;
					$acr->actualizacionid = $ac->actualizacionid;
					$acr->archivo         = $nombre;
					$acr->save();
				}
	    }
		});

		//muestra mensaje
		Session::flash('message', 'Solicitud de actualización de información ingresada exitosamente.');
		Session::flash('type', 'success');

		//ENVIAR CORREO!!!!
		$admins   = Usuario::listAdminEmails();
		$empresas = Usuario::listEmpresaEmails(Auth::user()->empresaid, Auth::id());

		try {
			Mail::send('emails/solicitudactualizacion', array(
				'nombre'  => Auth::user()->nombre,
				'empresa' => $empresa->razonsocial), function($msg) use ($admins, $empresas){
	       	$msg->to(Auth::user()->email)->subject('Solicitud de Actualización DACE - MINECO');
	       	$msg->cc($empresas);
	       	$msg->bcc($admins);
			});
		} catch (Exception $e) {}

		return Redirect::to('inicio');
	}
}
