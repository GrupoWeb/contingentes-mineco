<?php

class solicitudreinscripcionController extends crudController {
	public function index(){    
    return View::make('inscripcion/reinscripcion')
    	->with('tratados', Tratado::getTratados());
  }
  
  public function store(){
  	$contingenteid  = Crypt::decrypt(Input::get('cmbContingente'));
 
		$requerimientos = Contingenterequerimiento::getRequerimientos($contingenteid, 'inscripcion');

		if(count(Input::file()) <= 0 && count($requerimientos) > 0) {
			Session::flash('message', 'No se ha cumplido con los requerimientos de archivos necesarios');
			Session::flash('type', 'danger');

			return Redirect::to('/');
		}
    
		DB::transaction(function() use ($contingenteid) {

	    $empresaId = Auth::user()->empresaid;
	      
    	DB::table('empresacontingentes')->insert(array(
				'empresaid'     => $empresaId, 
				'contingenteid' => $contingenteid
    	));
	    
	    
	    foreach (Input::file() as $key=>$val) { 
	      if ($key=='txArchivo') continue;
	    	if ($val) {
					$arch   = Input::file($key);
					$nombre = date('YmdHis').$arch->getClientOriginalName();
					$res    = $arch->move(public_path() . '/archivos/' . $empresaId, $nombre);
					DB::table('empresarequerimientos')->insert(array(
						'empresaid'        => $empresaId,
						'requerimientoid'  => substr($key,4),
						'archivo'          => $nombre,
						'created_at'       => date_create(),
						'updated_at'       => date_create()
					));
				}
	    }
	  }); //DB Transaction

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

  	return Redirect::to('/')
    	->with('flashMessage',Config::get('login::signupexitoso'))
    	->with('flashType','success');
  }