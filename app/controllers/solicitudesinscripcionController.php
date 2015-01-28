<?php
class solicitudesinscripcionController extends crudController {

	public function __construct() {
		Crud::setExport(false);
		Crud::setSearch(false);
		Crud::setTitulo('Solicitudes pendientes - Inscripción');
		Crud::setTabla('authusuarios');
		Crud::setTablaId('usuarioid');
		Crud::setWhere('authusuarios.activo',0);

		Crud::setCampo(array('nombre'=>'Nombre','campo'=>'nombre'));
		Crud::setCampo(array('nombre'=>'Email','campo'=>'email'));
		Crud::setCampo(array('nombre'=>'Fecha de solicitud','campo'=>'created_at', 'tipo'=>'datetime'));
		Crud::setCampo(array('nombre'=>'Activo','campo'=>'activo','tipo'=>'bool'));
		Crud::setPermisos(Cancerbero::tienePermisosCrud('solicitudespendientes.inscripcion'));
	}
	public function index(){
		$solicitudes = Inscripcionpendiente::getSolicitudesPendientes();
		$columnas = array(
			array("tipo"=>"string"),
			array("tipo"=>"string"),
			array("tipo"=>"datetime"),
			array("tipo"=>"bool")
		);
		return View::make('solicitudespendientes/inscripcionesindex')
			->with("solicitudes",$solicitudes)
			->with("columnas",$columnas);
	
	}
	public function edit($id){
		$arr            = explode("+",Crypt::decrypt($id));
		$userID         = $arr[0];
		$contingenteid  = $arr[1];
		$solicitud      = Inscripcionpendiente::getSolicitudPendiente($userID,$contingenteid);
		$requerimientos = Usuariorequerimiento::getUsuarioContingenteRequerimientos($userID,$contingenteid);

		return View::make('solicitudespendientes/inscripciones')
			->with('solicitud',$solicitud)
			->with('cid',Crypt::encrypt($contingenteid))
			->with('requerimientos',$requerimientos);
	}

	public function store(){
		$elID = Crypt::decrypt(Input::get('id'));
		$contingenteid = Crypt::decrypt(Input::get('cid'));
      
		if(Input::has('btnAutorizar')) {
			$usuario         = Inscripcionpendiente::find($elID);
			if($usuario->activo==0){
				$usuario->activo = 1;
				$result  = $usuario->save();
			}
			
			$solicitud = Usuariocontingente::where("usuarioid",$elID)->where("contingenteid",$contingenteid)->first();
			$solicitud->activo = 1;
			$result = $solicitud->save();
			if($result) {
				$email = $usuario->email;

				Session::flash('type','success');
				Session::flash('message','La solicitud de inscripción fue procesada correctamente');

				Mail::send('emails/solicitudinscripcionresultado', array(
					'nombre'        => $usuario->nombre,
					'fecha'         => $usuario->created_at,
					'estado'        => 'Aprobada',
					'observaciones' => Input::get('txObservaciones')), function($msg) use ($email){
		       	$msg->to($email)->subject('Solicitud de Inscripción DACE - MINECO');
				});
			}
			else {
				Session::flash('type','warning');
				Session::flash('message','Ocurrió un error al intentar autorizar, intente de nuevo.');
			}
		}
		else {
          
			$affectedRows = Usuariocontingente::where('usuarioid', $elID)->where('contingenteid', $contingenteid)->delete();
		
          $requerimientos = Contingenterequerimiento::getRequerimientos(Input::get('cid'));
			
          $reqIDs= array();
			foreach($requerimientos as $r){
				array_push($reqIDs,$r->requerimientoid);
			}
			// $reqIDs=implode($reqIDs,",");
			
			
			foreach($reqIDs as $rid){
				$affectedRows2 = Usuariorequerimiento::leftJoin("contingenterequerimientos AS cr","usuariorequerimientos.requerimientoid","=","cr.requerimientoid")
					->leftJoin("usuariocontingentes AS uc","cr.contingenteid","=","uc.contingenteid")
					->where("usuariorequerimientos.requerimientoid","=",$rid)
					->where("usuariorequerimientos.usuarioid","=",$elID)
					->where("uc.contingenteid","!=",$contingenteid)->count();
					if($affectedRows2==0)
						Usuariorequerimiento::where('usuarioid', $elID)->where("usuariorequerimientos.requerimientoid","=",$rid)->delete();
			}
              echo $contingenteid;
                exit;	

				
			
				$usuario = Inscripcionpendiente::find($elID);
				$nombre  = $usuario->nombre;
				$email   = $usuario->email;
			
			//revisar si no hay otras solicitudes
			$pendientes = Usuariocontingente::where('usuarioid', $elID)->count();
			if($pendientes==0){
				$result  = $usuario->delete();
			}
          
			if($affectedRows || $result) {
				Session::flash('type','success');
				Session::flash('message','La solicitud de inscripción fue rechazada');

				Mail::send('emails/solicitudinscripcionresultado', array(
					'nombre'        => $usuario->nombre,
					'fecha'         => $usuario->created_at,
					'estado'        => 'Rechazada',
					'observaciones' => Input::get('txObservaciones')), function($msg) use ($email){
		       	$msg->to($email)->subject('Solicitud de Inscripción DACE - MINECO');
				});
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
     
        $con = DB::table("usuariocontingentes")->select("contingenteid")->where("usuarioid",Auth::id())->get();
        foreach($con as $k=>$v)
          array_push($usuarioCon,$v->contingenteid);
        
    return View::make('inscripcion/reinscripcion')
        ->with('route', 'solicitud.inscripcion.update')
        ->with('contingentes', Contingente::getContingentes($usuarioCon));
	
  }
  
  public function update($id){
    
	DB::transaction(function() {

        $usuarioId = Auth::id();
      
	    foreach (Input::get('contingentes') as $val) {
	    	DB::table('usuariocontingentes')->insert(array(
					'usuarioid'     => $usuarioId, 
					'contingenteid' => Crypt::decrypt($val))
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

    $email = Auth::user()->email;
    Mail::send('emails/solicitudinscripcion', array(
      'nombre' => Auth::user()->nombre,
      'fecha'  => date('d-m-Y H:i')
      ), function($msg) use ($email){
            $msg->to($email)->subject('Solicitud de inscripción');
    });

   return Redirect::to('/')
      ->with('flashMessage',Config::get('login::signupexitoso'))
      ->with('flashType','success');
	
	
  }
}