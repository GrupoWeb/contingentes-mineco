<?php

class inscripcionController extends BaseController {

	public function index() {
		return View::make('inscripcion/template')
			->with('route', 'signup.store')
			->with('contingentes', Contingente::getContingentes());
	}

	public function validateEmail() {
    $aEmail = Input::get(Config::get('login::usuario.campo'));
		$result = DB::table(Config::get('login::tabla'))->where('email', $aEmail)->first();
    if ($result) $val='false';
    else $val='true';
    return json_encode(array('valid'=>$val));
	}

	public function store() {
		DB::transaction(function() {
	    $usuario = DB::table('authusuarios');
	   
	    $arr = array(
	      'email'      => Input::get('email'),
	      'nombre'     => Input::get('txNombre'),
	      'password'   => Hash::make(Input::get('txPassword')),
	      'rolid'      => 3,
	      'activo'     => 0,
	      'created_at' => date_create(),
	      'updated_at' => date_create()
	    );
	    $usuarioId = $usuario->insertGetId($arr);

	    foreach (Input::get('contingentes') as $val) {
	    	DB::table('usuariocontingentes')->insert(array(
					'usuarioid'     => $usuarioId, 
					'contingenteid' => $val)
	    	);
	    }
	    
	    foreach (Input::file() as $key=>$val) { 
	      if ($key=='txArchivo') continue;
	    	if ($val) {
					$arch   = Input::file($key);
					$nombre = date('YmdHis').$arch->getClientOriginalName();
					$res    = $arch->move(public_path() . '/archivos/' . $usuarioId, $nombre);
					DB::table('usuariorequerimientos')->insert(array(
						'usuarioid'        => $usuarioId,
						'requerimientoid'  => substr($key,4),
						'archivo'          => $nombre,
						'created_at'       => date_create(),
						'updated_at'       => date_create()
					));
				}
	    }
	  }); //DB Transaction

    $email = Input::get('email');
    Mail::send('emails/solicitudinscripcion', array(
      'nombre' => Input::get('txNombre'),
      'fecha'  => date('d-m-Y H:i')
      ), function($msg) use ($email){
            $msg->to($email)->subject('Solicitud de inscripción');
    });

    return Redirect::to('/login')
      ->with('flashMessage',Config::get('login::signupexitoso'))
      ->with('flashType','success');
	}
}