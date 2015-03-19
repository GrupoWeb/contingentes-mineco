<?php

class inscripcionController extends BaseController {

	public function index() {
		return View::make('inscripcion/index')
			->with('route', 'signup.store')
			->with('tratados', Tratado::getTratados());
	}

	public function validateEmail() {
    $aEmail = Input::get(Config::get('login::usuario.campo'));
		$result = DB::table(Config::get('login::tabla'))->where('email', $aEmail)->first();
    
    if ($result) 
    	$val='false';

    else {
    	$result = DB::table('solicitudinscripciones')->where('email', $aEmail)->where('estado', 'Pendiente')->first();
    	if ($result) 
    		$val='false';
    	
    	else 
    		$val='true';
    }

    return json_encode(array('valid'=>$val));
	}

	public function validateNIT() {
    $aNIT = Input::get('txNIT');
		$result = DB::table('authusuarios')->where('nit', $aNIT)->first();

    if ($result) 
    	$val='false';

    else {
    	$result = DB::table('solicitudinscripciones')->where('nit', $aNIT)->where('estado', 'Pendiente')->first();
    	if ($result) 
    		$val='false';
    	else 
    		$val='true';
    }

    return json_encode(array('valid'=>$val));
	}

	public function getContingentes($tratadoid) {
		return View::make('inscripcion.contingentes')
			->with('contingentes', Contingente::getContTratado($tratadoid));
	}
	
	public function store() {
		DB::transaction(function() {
			$inscripcion                          = new Solicitudinscripcion;
			$inscripcion->estado                  = 'Pendiente';
			$inscripcion->email                   = Input::get('email');
			$inscripcion->password                = Hash::make(Input::get('txPassword'));
			$inscripcion->nit                     = Input::get('txNIT');
			$inscripcion->nombre                  = Input::get('txRazonSocial');
			$inscripcion->propietario             = Input::get('txPropietario');
			$inscripcion->domiciliofiscal         = Input::get('txDomicilioFiscal');
			$inscripcion->domiciliocomercial      = Input::get('txDomicilioComercial');
			$inscripcion->direccionnotificaciones = Input::get('txDireccionNotificaciones');
			$inscripcion->telefono                = Input::get('txTelefono');
			$inscripcion->fax                     = Input::get('txFax');
			$inscripcion->encargadoimportaciones  = Input::get('txEncargadoImportaciones');
			$inscripcion->save();

			$contingente = new Solicitudinscripcioncontingente;
			$contingente->solicitudinscripcionid = $inscripcion->solicitudinscripcionid;
			$contingente->contingenteid = Crypt::decrypt(Input::get('contingentes'));
			$contingente->save();

			foreach (Input::file() as $key=>$val) { 
	      if ($key == 'txArchivo') continue;
	    	if ($val) {
					$arch   = Input::file($key);
					$nombre = date('YmdHis').$arch->getClientOriginalName();
					$res    = $arch->move(public_path() . '/archivos/solicitudes/'.$inscripcion->solicitudinscripcionid, $nombre);
					
					$requerimiento                         = new Solicitudinscripcionrequemiento;
					$requerimiento->solicitudinscripcionid = $inscripcion->solicitudinscripcionid;
					$requerimiento->requerimientoid        = substr($key,4);
					$requerimiento->archivo                = $nombre;
					$requerimiento->save();
				}
	    }
	  }); //DB Transaction

		$email  = Input::get('email');
		$admins = Usuario::listAdminEmails();

		try {
			Mail::send('emails/solicitudinscripcion', array(
	      'nombre' => Input::get('txRazonSocial'),
	      'fecha'  => date('d-m-Y H:i')
	      ), function($msg) use ($email, $admins){
	            $msg->to($email)->subject('Solicitud de inscripción');
	            $msg->bcc($admins);
	    });
		} catch (Exception $e) {}

    return Redirect::to('/login')
      ->with('flashMessage',Config::get('login::signupexitoso'))
      ->with('flashType','success');
	}
}