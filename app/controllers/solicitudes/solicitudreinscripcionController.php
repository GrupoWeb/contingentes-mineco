<?php

class solicitudreinscripcionController extends crudController {
	public function index(){    
		//retorna datos a la vista
    return View::make('inscripcion/reinscripcion')
    	->with('tratados', Tratado::getTratados());
  }
  
  public function store(){
  	//captura valor del hidden y valida
  	if (!Input::has('cmbContingente')) {
  		Session::flash('message', 'Contingente inválido');
			Session::flash('type', 'danger');
			return Redirect::to('/solicitud/inscripcion');
  	}

  	//asigna valor de hidden
  	$contingenteid  = Crypt::decrypt(Input::get('cmbContingente'));

  	//condiciona y consulta en db segun condicion
		$requerimientos = array();
		if(Auth::check()) {
			$requerimientos = Empresarequerimiento::getEmpresaRequerimientosIds();
		}

		//consulta en db segun parametros
		$requerimientos = Contingenterequerimiento::getRequerimientos($contingenteid, 'Inscripcion', $requerimientos);

		//mostrar mensaje
		if(count(Input::file()) <= 0 && count($requerimientos) > 0) {
			Session::flash('message', 'No se ha cumplido con los requerimientos de archivos necesarios');
			Session::flash('type', 'danger');

			//retona a la vista
			return Redirect::to('inicio');
		}
    
    //inserta datos en db
		DB::transaction(function() use($contingenteid) {
			$empresa = Empresa::find(Auth::user()->empresaid);

			$inscripcion                          = new Solicitudinscripcion;
			$inscripcion->estado                  = 'Pendiente';
			$inscripcion->email                   = Auth::user()->email;
			$inscripcion->password                = Auth::user()->password;
			$inscripcion->nit                     = $empresa->nit;
			$inscripcion->nombre                  = $empresa->razonsocial;
			$inscripcion->propietario             = $empresa->propietario;
			$inscripcion->domiciliofiscal         = $empresa->domiciliofiscal;
			$inscripcion->domiciliocomercial      = $empresa->domiciliocomercial;
			$inscripcion->direccionnotificaciones = $empresa->direccionnotificaciones;
			$inscripcion->telefono                = $empresa->telefono;
			$inscripcion->fax                     = $empresa->fax;
			$inscripcion->encargadoimportaciones  = $empresa->encargadoimportaciones;
			$inscripcion->codigovupe              = $empresa->codigovupe;
			$inscripcion->save();

			$contingente                         = new Solicitudinscripcioncontingente;
			$contingente->solicitudinscripcionid = $inscripcion->solicitudinscripcionid;
			$contingente->contingenteid          = $contingenteid;
			$contingente->save();

			foreach (Input::file() as $key=>$val) { 
	      if ($key == 'txArchivo') continue;
	    	if ($val) {
					$arch   = Input::file($key);
					$nombre = date('Ymdhis') . mt_rand(1, 1000) . '.' . strtolower($arch->getClientOriginalExtension());
					$res    = $arch->move(public_path() . '/archivos/solicitudes/'.$inscripcion->solicitudinscripcionid, $nombre);
					
					$requerimiento                         = new Solicitudinscripcionrequemiento;
					$requerimiento->solicitudinscripcionid = $inscripcion->solicitudinscripcionid;
					$requerimiento->requerimientoid        = substr($key,4);
					$requerimiento->archivo                = $nombre;
					$requerimiento->save();
				}
	    }
	  }); //DB Transaction

		//manda email
		$email    = Auth::user()->email;
		$admins   = Usuario::listAdminEmails();
		$empresas = Usuario::listEmpresaEmails(Auth::user()->empresaid, Auth::id());
	    
	  try {
	  	Mail::send('emails/solicitudinscripcion', array(
	      'nombre' => Auth::user()->nombre,
	      'fecha'  => date('d-m-Y H:i')
	      ), function($msg) use ($email, $admins, $empresas){
	            $msg->to($email)->subject('Solicitud de inscripción');
	            $msg->cc($empresas);
	            $msg->bcc($admins);
	    });
	  } catch (Exception $e) {}

		//muestra mensaje
		Session::flash('message', 'Su solicitud de inscripción ha sido enviada');
		Session::flash('type', 'success');

		//retorna a la vista
  	return Redirect::to('inicio');
  }
}