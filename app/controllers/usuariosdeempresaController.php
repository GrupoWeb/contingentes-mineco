<?php

class usuariosdeempresaController extends crudController {

	public function __construct() {
    Crud::setTitulo('Usuarios de empresas');
    Crud::setTablaId('usuarioid');
    Crud::setTabla('authusuarios');

    Crud::setWhereRaw("rolid IN (". implode(',', Config::get('contingentes.rolempresa')) .")");

    Crud::setCampo(array('nombre'=>'Nombre','campo'=>'authusuarios.nombre','reglas' => array('notEmpty'),'reglasmensaje'=>'El nombre es requerido'));
    Crud::setCampo(array('nombre'=>'Email','campo'=>'email','reglas' => array('notEmpty','email'),'reglasmensaje'=>'El email es requerido y debe ser valido'));
    Crud::setCampo(array('nombre'=>'Creado','campo'=>'authusuarios.created_at','tipo'=>'datetime','editable'=>false));
    Crud::setCampo(array('nombre'=>'Activo','campo'=>'authusuarios.activo','tipo'=>'bool'));
    Crud::setCampo(array('nombre'=>'Contraseña','campo'=>'password','tipo'=>'password','show'=>false));

    Crud::setBotonExtra(array('url'=>'usuarios/perfil/{id}','class'=>'success','icon'=>'fa fa-user','titulo'=>'Perfil'));

    Crud::setPermisos(Cancerbero::tienePermisosCrud('usuarioempresas'));
  }

  public function edit($id) {
    $id      = Crypt::decrypt($id);
    $usuario = Usuario::find($id);

    return View::make('usuarios.edit')
      ->with('usuario', $usuario);
  }

  public function update($id) {
    $id      = Crypt::decrypt($id);

    $usuario                          = Usuario::find($id);
    $usuario->nit                     = Input::get('txNIT');
    $usuario->nombre                  = Input::get('txRazonSocial');
    $usuario->propietario             = Input::get('txPropietario');
    $usuario->email                   = Input::get('email');
    $usuario->telefono                = Input::get('txTelefono');
    $usuario->fax                     = Input::get('txFax');
    $usuario->domiciliofiscal         = Input::get('txDomicilioFiscal');
    $usuario->domiciliocomercial      = Input::get('txDomicilioComercial');
    $usuario->direccionnotificaciones = Input::get('txDireccionNotificaciones');
    $usuario->encargadoimportaciones  = Input::get('txEncargadoImportaciones');
    $usuario->activo                  = Input::get('activo', 0);

    if(Input::get('txPassword') <> '')
      $usuario->password = Hash::make(Input::get('txPassword'));

    $usuario->save();

    Session::flash('message', 'Usuario editado exitosamente');
    Session::flash('type', 'success');

    return Redirect::to('usuarioempresas');
  }
  
  
  public function perfil($id){
    $userID = Crypt::decrypt($id);
    $datos = DB::table("authusuarios AS au")
      ->leftJoin('authroles AS ar','au.rolid','=','ar.rolid')
      ->select('au.nombre','ar.nombre AS rol','au.email',DB::raw('DATE_FORMAT(au.created_at, "%d-%m-%Y %H:%m:%s") AS creado'),'au.usuarioid')
      ->where('au.usuarioid',$userID)
      ->first();
    
    $contingentes   = Usuariocontingente::contingentesUsuario($userID);
    $requerimientos = Usuariorequerimiento::getUsuarioRequerimientos($userID);
    
    $emisiones = DB::table('solicitudesemision AS se')
            ->select('se.solicitado','se.estado','se.emitido','se.observaciones',DB::raw('DATE_FORMAT(se.created_at,"%d-%m-%Y") AS fechasolicitud'),DB::raw('CONCAT(t.nombrecorto," - ",pro.nombre) AS contingente'))
            ->leftJoin('periodos AS p','p.periodoid','=','se.periodoid')
            ->leftJoin('contingentes AS c','p.contingenteid','=','c.contingenteid')
            ->leftJoin('tratados AS t','t.tratadoid','=','c.tratadoid')
            ->leftJoin('productos AS pro','pro.productoid','=','c.productoid')
            ->where('se.usuarioid',$userID)
            ->get();

    $emisionRequerimientos = DB::table('solicitudemisionrequerimientos AS ser')
			->select('ser.archivo','r.nombre','r.requerimientoid')
			->leftJoin('requerimientos AS r','ser.requerimientoid','=','r.requerimientoid')
			->leftJoin('solicitudesemision AS se','ser.solicitudemisionid','=','se.solicitudemisionid')
			->where('se.usuarioid',$userID)
			->get();
        
    $asignaciones = DB::table('solicitudasignacion AS sa')
            ->select('sa.solicitado','sa.estado','sa.observaciones',DB::raw('DATE_FORMAT(sa.created_at,"%d-%m-%Y") AS fechasolicitud'),DB::raw('CONCAT(t.nombrecorto," - ",pro.nombre) AS contingente'))
            ->leftJoin('periodos AS p','p.periodoid','=','sa.periodoid')
            ->leftJoin('contingentes AS c','p.contingenteid','=','c.contingenteid')
            ->leftJoin('tratados AS t','t.tratadoid','=','c.tratadoid')
            ->leftJoin('productos AS pro','pro.productoid','=','c.productoid')
            ->where('sa.usuarioid',$userID)
            ->get();
    $asignacionRequerimientos = DB::table('solicitudasignacionrequerimientos AS sar')
			->select('sar.archivo','r.nombre','r.requerimientoid')
			->leftJoin('requerimientos AS r','sar.requerimientoid','=','r.requerimientoid')
			->leftJoin('solicitudasignacion AS sa','sa.solicitudasignacionid','=','sar.solicitudasignacionid')
			->where('sa.usuarioid',$id)
			->get();
    
    $archivos = array();
    foreach($requerimientos as $req){
      if(!isset($archivos[$req->requerimientoid]))
        $archivos[$req->requerimientoid] = $req;
    }
    
      foreach($emisionRequerimientos as $req){
      if(!isset($archivos[$req->requerimientoid]))
        $archivos[$req->requerimientoid] = $req;
    }
    
      foreach($asignacionRequerimientos as $req){
      if(!isset($archivos[$req->requerimientoid]))
        $archivos[$req->requerimientoid] = $req;
    }
    
    return View::make('usuarios/perfil')
      ->with('contingentes', $contingentes)
      ->with('requerimientos', $archivos)
      ->with('emisiones', $emisiones)
      ->with('asignaciones', $asignaciones)
      ->with('usuario', $datos);
    
  }
}
