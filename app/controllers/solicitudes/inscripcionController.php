<?php

class inscripcionController extends BaseController {

	public function index() {
		//retorna valores a la vista
		return View::make('inscripcion/index')
			->with('route', 'signup.store')
			->with('tratados', Tratado::getTratados());
	}

	public function validateEmail() {
		//captura email de formulario
    $aEmail = Input::get('email');

    $userid = 0;
    //condiciona valor de formulario
    if(Input::has('u'))
    	$userid = Crypt::decrypt(Input::get('u'));

    //asigna valor de la consulta del db
		$result = DB::table('authusuarios')->where('email', $aEmail);

		//condiciona $userid
		if($userid <> 0)
			$result->where('usuarioid', '<>', $userid);

		//asigna valor de la condicion
		$result = $result->first();
    
    //condiciona $result
    if ($result) 
    	$val='false';

    else {
    	//asigna valor de consulta en db segun parametros
    	$result = DB::table('solicitudinscripciones')->where('email', $aEmail)->where('estado', 'Pendiente')->first();

    	if ($result) 
    		$val='false';
    	
    	else 
    		$val='true';
    }

    //retorna los datos al areglo
    return json_encode(array('valid'=>$val));
	}

	public function validateNIT() {
    /*$aNIT = Input::get('txNIT');

    $empresaid = 0;
    if(Input::has('u'))
    	$empresaid = Crypt::decrypt(Input::get('u'));

    $result = DB::table('empresas')->where('nit', $aNIT);

		if($empresaid <> 0)
			$result->where('empresaid', '<>', $empresaid);

		$result = $result->first();

    if ($result) 
    	$val='false';

    else {
    	$result = DB::table('solicitudinscripciones')->where('nit', $aNIT)->where('estado', 'Pendiente')->first();
    	if ($result) 
    		$val='false';
    	else 
    		$val='true';
    }*/
    $val = 'true';
    //retorna datos
    return json_encode(array('valid'=>$val));
	}

	public function getContingentes($tratadoid) {
		//captura tratadoid
		$tratadoid = Crypt::decrypt($tratadoid);

		if(Auth::check()) {
			$usuarioCon = array();
    	$exclude    = DB::table("empresacontingentes")
    		->where("empresaid",Auth::user()->empresaid)->lists("contingenteid");
	    $contingentes =  Contingente::getContTratado($tratadoid, $exclude);
		}
		else
			$contingentes = Contingente::getContTratado($tratadoid);

		//retorna datos a la vista
		return View::make('inscripcion.contingentes')
			->with('contingentes', $contingentes);
	}
	
	public function store() {
		//verifica valor del formulario
		if(!Input::has('cmbContingente')) {
			//muestra mensaje
			Session::flash('message', 'Se dio un error al seleccionar un contingente. Inténtalo nuevamente');
			Session::flash('type', 'danger');

			//retorna a la vistas
			return Redirect::to('/signup');
		}

		//asigna valor del formulario y consulta en db segun los paremetros
		$contingenteid  = Crypt::decrypt(Input::get('cmbContingente'));
		$requerimientos = Contingenterequerimiento::getRequerimientos($contingenteid, 'inscripcion');

		//condiciona file
		if(count(Input::file()) <= 0 && count($requerimientos) > 0) {
			Session::flash('message', 'No se ha cumplido con los requerimientos de archivos necesarios');
			Session::flash('type', 'danger');

			return Redirect::to('/signup');
		}

		//asigna valores
		$nit       = Input::get('txNIT');
		$empresa   = DB::table('empresas')->where('nit', $nit)->first();
		$solicitud = DB::table('solicitudinscripciones')->where('nit', $nit)->where('estado', 'Pendiente')->first();

		//condiciona solicitud y empresa y muetra mensaje
		if($solicitud || $empresa) {
			Session::flash('message', 'El NIT ya se encuentra registrado en el sistema');
			Session::flash('type', 'danger');

			//retorna a la vista
			return Redirect::to('/signup');
		}

		//inserta valores a la db
		DB::transaction(function() use($contingenteid,$nit) {
			$inscripcion                          = new Solicitudinscripcion;
			$inscripcion->estado                  = 'Pendiente';
			$inscripcion->email                   = Input::get('email');
			$inscripcion->password                = Hash::make(Input::get('txPassword'));
			$inscripcion->nit                     = $nit;
			$inscripcion->nombre                  = Input::get('txRazonSocial');
			$inscripcion->propietario             = Input::get('txPropietario');
			$inscripcion->domiciliofiscal         = Input::get('txDomicilioFiscal');
			$inscripcion->domiciliocomercial      = Input::get('txDomicilioComercial');
			$inscripcion->direccionnotificaciones = Input::get('txDireccionNotificaciones');
			$inscripcion->telefono                = Input::get('txTelefono');
			$inscripcion->fax                     = Input::get('txFax');
			$inscripcion->encargadoimportaciones  = Input::get('txEncargadoImportaciones');
			$inscripcion->codigovupe              = Input::get('txVUPE');
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

		//asigna valores del formulario
		$email    = Input::get('email');
		$admins   = Usuario::listAdminEmails();

		//consulta en db segun parametros
		$contingente = Contingente::getNombre($contingenteid);
		//condiciona le objeto
		if($contingente) {
			$despedida = 'Para mayor información puede escribir a: 
						<a href="mailto:' . $contingente->responsableemail . '">' . $contingente->responsable . 
						' &lt;' . $contingente->responsableemail . '&gt;</a> o ingresando a la página web 
						<a href="' . url() .'">' . url() . '</a>';
		}
		else {
			$despedida = null;
		}

		//manda email
		try {
			Mail::send('emails/solicitudinscripcion', array(
	      'nombre' => Input::get('txRazonSocial'),
	      'fecha'  => date('d-m-Y H:i'),
	      'despedida' => $despedida
	      ), function($msg) use ($email, $admins, $empresas){
	            $msg->to($email)->subject('Solicitud de inscripción');
	            $msg->bcc($admins);
	    });
		} catch (Exception $e) {}

		//retorna a la vista si existe error
    return Redirect::to('/login')
      ->with('flashMessage',Config::get('login::signupexitoso'))
      ->with('flashType','success');
	}
}