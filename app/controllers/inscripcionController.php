<?php

class inscripcionController extends BaseController {

	public function index() {
		return View::make('inscripcion/index')
			->with('route', 'signup.store')
			->with('tratados', Tratado::getTratados());
	}

	public function validateEmail() {
    $aEmail = Input::get('email');

    $userid = 0;
    if(Input::has('u'))
    	$userid = Crypt::decrypt(Input::get('u'));

		$result = DB::table('authusuarios')->where('email', $aEmail);

		if($userid <> 0)
			$result->where('usuarioid', '<>', $userid);

		$result = $result->first();
    
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
    }

    return json_encode(array('valid'=>$val));
	}

	public function getContingentes($tratadoid) {
		if(Auth::check()) {
			$usuarioCon = array();
    	$con        = DB::table("empresacontingentes")->select("contingenteid")->where("empresaid",Auth::user()->empresaid) ->get();

	    foreach($con as $k=>$v)
	      array_push($usuarioCon,$v->contingenteid);

	    $contingentes =  Contingente::getContTratado($tratadoid, $usuarioCon);
		}

		else
			$contingentes = Contingente::getContTratado($tratadoid);

		return View::make('inscripcion.contingentes')
			->with('contingentes', $contingentes);
	}
	
	public function store() {
		$contingnete    = Crypt::decrypt(Input::get('contingentes'));
		$requerimientos = Contingenterequerimiento::getRequerimientos($contingenteid, 'inscripcion');

		if(count(Input::file()) <= 0 && count($requerimientos) > 0) {
			Session::flash('message', 'No se ha cumplido con los requerimientos de archivos necesarios');
			Session::flash('type', 'danger');

			return Redirect::to('/');
		}

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

		$email    = Input::get('email');
		$admins   = Usuario::listAdminEmails();
		$empresas = Usuario::listEmpresaEmails(Auth::user()->empresaid, Auth::id());

		try {
			Mail::send('emails/solicitudinscripcion', array(
	      'nombre' => Input::get('txRazonSocial'),
	      'fecha'  => date('d-m-Y H:i')
	      ), function($msg) use ($email, $admins, $empresas){
	            $msg->to($email)->subject('Solicitud de inscripción');
	            $msg->cc($empresas);
	            $msg->bcc($admins);
	    });
		} catch (Exception $e) {}

    return Redirect::to('/login')
      ->with('flashMessage',Config::get('login::signupexitoso'))
      ->with('flashType','success');
	}
}