<?php

class solicitudesinscripcionController extends crudController {

	public function __construct() {
		Crud::setExport(false);
		Crud::setSearch(false);
		Crud::setTitulo('Solicitudes pendientes - Inscripción');
		Crud::setTabla('solicitudinscripciones');
		Crud::setTablaId('solicitudinscripcionid');

		Crud::setWhere('estado', 'Pendiente');

		Crud::setCampo(array('nombre'=>'Nombre','campo'=>'solicitudinscripciones.nombre'));
		Crud::setCampo(array('nombre'=>'Tratado','campo'=>'(SELECT t.nombrecorto FROM solicitudinscripcioncontingentes AS sic LEFT JOIN contingentes AS c ON sic.contingenteid = c.contingenteid LEFT JOIN tratados AS t ON c.tratadoid = t.tratadoid WHERE sic.solicitudinscripcionid = solicitudinscripciones.solicitudinscripcionid)'));
		Crud::setCampo(array('nombre'=>'Tratado','campo'=>'(SELECT p.nombre FROM solicitudinscripcioncontingentes AS sic LEFT JOIN contingentes AS c ON sic.contingenteid = c.contingenteid LEFT JOIN productos AS p ON c.productoid = p.productoid WHERE sic.solicitudinscripcionid = solicitudinscripciones.solicitudinscripcionid)'));
		Crud::setCampo(array('nombre'=>'Email','campo'=>'email'));
		Crud::setCampo(array('nombre'=>'Fecha de solicitud','campo'=>'solicitudinscripciones.created_at', 'tipo'=>'datetime'));

		Crud::setPermisos(Cancerbero::tienePermisosCrud('solicitudespendientes.inscripcion'));
	}

	public function edit($id){
		$solicitudid    = Crypt::decrypt($id);
		$solicitud      = Solicitudinscripcion::getSolicitudPendiente($solicitudid);
		$contingente    = Solicitudinscripcioncontingente::where('solicitudinscripcionid', $solicitudid)->first();
		$requerimientos = Solicitudinscripcionrequemiento::getRequerimientosSolicitud($solicitudid);

		return View::make('solicitudespendientes/inscripciones')
			->with('solicitud', $solicitud)
			->with('cid', Crypt::encrypt($contingente->contingenteid))
			->with('requerimientos', $requerimientos);
	}

	public function store(){
		$solicitudid   = Crypt::decrypt(Input::get('id'));
		$contingenteid = Crypt::decrypt(Input::get('cid'));
      
    // aprobado
		if(Input::has('btnAutorizar')) { 
			$result = DB::transaction(function() use ($solicitudid, $contingenteid) {
				$result = true;

				//copiar a tabla authusuarios
				$solicitud  = Solicitudinscripcion::find($solicitudid);
				$rolempresa = Config::get('contingentes.rolempresa');

				$empresaid = DB::table('empresas')->insertGetId(
					array(					
						'nit'                     => $solicitud->nit,
						'razonsocial'             => $solicitud->nombre,
						'propietario'             => $solicitud->propietario,
						'domiciliofiscal'         => $solicitud->domiciliofiscal,
						'domiciliocomercial'      => $solicitud->domiciliocomercial,
						'direccionnotificaciones' => $solicitud->direccionnotificaciones,
						'telefono'                => $solicitud->telefono,
						'fax'                     => $solicitud->fax,
						'encargadoimportaciones'  => $solicitud->encargadoimportaciones,
						'created_at'              => date_create(),
						'updated_at'              => date_create()
					)
				);
				if($empresaid == 0) return 0;

				$usuarioid  = DB::table('authusuarios')->insertGetId(
					array(
						'empresaid'  => $empresaid,
						'nombre'     => $solicitud->nombre,
						'email'      => $solicitud->email,
						'password'   => $solicitud->password,
						'created_at' => date_create(),
						'updated_at' => date_create(),
						'rolid'      => $rolempresa[0],
						'activo'     => 1
					)
				);


				if($usuarioid == 0) return 0;

				//copiar a empresacontingentes
				$econtingente                = new Empresacontingente;
				$econtingente->empresaid     = $empresaid;
				$econtingente->contingenteid = $contingenteid;
				$econtingente->save();


				if(!$econtingente) return 0;

				//copiar a empresarequerimientos
				$requerimientos = Solicitudinscripcionrequemiento::where('solicitudinscripcionid', $solicitudid)->get();
				foreach($requerimientos as $requerimiento) {
					$ureq                  = new Empresarequerimiento;
					$ureq->empresaid       = $empresaid;
					$ureq->requerimientoid = $requerimiento->requerimientoid;
					$ureq->archivo         = $requerimiento->archivo;
					$ureq->save();

					//copiar archivos de requerimientos a carpeta usuarios
					$source      = public_path().'/archivos/solicitudes/'.$solicitudid;
					$destination = public_path().'/archivos/'.$usuarioid;
					
					if(!is_dir($destination))
						mkdir($destination);



					if (file_exists($source.'/'.$requerimiento->archivo))
						rename($source.'/'.$requerimiento->archivo, $destination.'/'.$requerimiento->archivo);

					if(!is_dir($source))
						rmdir($source);
				}

				if(!$requerimientos) return 0;

				//actualizar registro en tabla solicitudes
				$solicitud->estado        = 'Aprobada';
				$solicitud->observaciones = Input::get('txObservaciones', '');
				$solicitud->save();

				return $usuarioid;
			}); //Transaction

			$admins  = Usuario::listAdminEmails();

			if($result <> 0) {
				$usuario  = DB::table('authusuarios')->where('usuarioid', $result)->first();
				$email    = $usuario->email;
				$empresas = Usuario::listEmpresaEmails($usuario->empresaid, $usuario->usuarioid);

				Session::flash('type','success');
				Session::flash('message','La solicitud de inscripción fue procesada correctamente');

				try {
					Mail::send('emails/solicitudinscripcionresultado', array(
						'nombre'        => $usuario->nombre,
						'fecha'         => $usuario->created_at,
						'estado'        => 'Aprobada',
						'observaciones' => Input::get('txObservaciones')), function($msg) use ($email, $admins, $empresas){
			       	$msg->to($email)->subject('Solicitud de Inscripción DACE - MINECO');
			       	$msg->cc($empresas);
			       	$msg->bcc($admins);
					});
				} catch (Exception $e) {}
			}
			else {
				Session::flash('type','warning');
				Session::flash('message','Ocurrió un error al intentar autorizar, intente de nuevo.');
			}
		}

		// rechazado
		else {
			$solicitud                = Solicitudinscripcion::find($solicitudid);
			$solicitud->estado        = 'Rechazada';
			$solicitud->observaciones = Input::get('txObservaciones', '');
			$solicitud->save();

			if($solicitud) {
				Session::flash('type','success');
				Session::flash('message','La solicitud de inscripción fue rechazada');

				$email = $solicitud->email;
				try {
					Mail::send('emails/solicitudinscripcionresultado', array(
						'nombre'        => $solicitud->nombre,
						'fecha'         => $solicitud->created_at,
						'estado'        => 'Rechazada',
						'observaciones' => Input::get('txObservaciones')), function($msg) use ($email, $admins){
			       	$msg->to($email)->subject('Solicitud de Inscripción DACE - MINECO');
			       	$msg->bcc($admins);
					});
				} catch (Exception $e) {}
			}

			else {
				Session::flash('type','warning');
				Session::flash('message','Ocurrió un error al intentar rechazar, intente de nuevo.');
			}
		}

		return Redirect::route('solicitudespendientes.inscripcion.index');
	}
  
  public function create(){
    
    $usuarioCon = array();
 
    $con = DB::table("empresacontingentes")->select("contingenteid")->where("empresaid",Auth::user()->empresaid) ->get();
    foreach($con as $k=>$v)
      array_push($usuarioCon,$v->contingenteid);
        
    return View::make('inscripcion/reinscripcion')
        ->with('contingentes', Contingente::getContingentes($usuarioCon));
	
  }
  
  public function update($id){
  	$contingnete    = Crypt::decrypt(Input::get('contingentes'));
		$requerimientos = Contingenterequerimiento::getRequerimientos($contingenteid, 'inscripcion');

		if(count(Input::file()) <= 0 && count($requerimientos) > 0) {
			Session::flash('message', 'No se ha cumplido con los requerimientos de archivos necesarios');
			Session::flash('type', 'danger');

			return Redirect::to('/');
		}
    
		DB::transaction(function() {

	    $empresaId = Auth::user()->empresaid;
	      
	    foreach (Input::get('contingentes') as $val) {
	    	DB::table('empresacontingentes')->insert(array(
					'empresaid'     => $empresaId, 
					'contingenteid' => Crypt::decrypt($val))
	    	);
	    }
	    
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
}