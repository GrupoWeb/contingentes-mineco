<?php

class usuariosController extends crudController {
  public function __construct() {
    Crud::setTitulo('Usuarios');
    Crud::setTablaId('usuarioid');
    Crud::setTabla('authusuarios');

    Crud::setLeftJoin('authroles AS r', 'authusuarios.rolid', '=', 'r.rolid');

    Crud::setCampo(array('nombre'=>'Nombre','campo'=>'authusuarios.nombre','reglas' => array('notEmpty'),'reglasmensaje'=>'El nombre es requerido'));
    Crud::setCampo(array('nombre'=>'Email','campo'=>'email','reglas' => array('notEmpty','email'),'reglasmensaje'=>'El email es requerido y debe ser valido'));
    Crud::setCampo(array('nombre'=>'Rol','campo'=>'r.nombre','editable'=>false));
    Crud::setCampo(array('nombre'=>'Rol','campo'=>'rolid','tipo'=>'combobox','query'=>'SELECT nombre, rolid FROM authroles ORDER BY nombre','combokey'=>'rolid','show'=>false));
    Crud::setCampo(array('nombre'=>'Creado','campo'=>'authusuarios.created_at','tipo'=>'datetime','editable'=>false));
    Crud::setCampo(array('nombre'=>'Activo','campo'=>'authusuarios.activo','tipo'=>'bool'));
    Crud::setCampo(array('nombre'=>'Contraseña','campo'=>'password','tipo'=>'password','show'=>false));
//
    Crud::setBotonExtra(array('url'=>'usuarios/perfil/{id}','class'=>'success','icon'=>'fa fa-user','titulo'=>'Perfil'));
//    Crud::setBotonExtra(array('url'=>'usuariotransportes/','class'=>'warning','icon'=>'fa fa-truck','titulo'=>'Asignar Transportes'));

    Crud::setPermisos(Cancerbero::tienePermisosCrud('usuarios'));
  }
  
  
  public function perfil($id){
    $userID = Crypt::decrypt($id);
    $datos = DB::table("authusuarios AS au")
      ->leftJoin('authroles AS ar','au.rolid','=','ar.rolid')
      ->select('au.nombre','ar.nombre AS rol','au.email',DB::raw('DATE_FORMAT(au.created_at, "%d-%m-%Y %H:%m:%s") AS creado'),'au.usuarioid','au.activo')
      ->where('au.usuarioid',$userID)
      ->first();
    
    $contingentes = Usuariocontingente::contingentesUsuario($userID);
    $requerimientos = Usuariorequerimiento::getUsuarioRequerimientos($userID);
    
    $emisionRequerimientos = DB::table('solicitudemisionrequerimientos AS ser')
			->select('ser.archivo','r.nombre')
			->leftJoin('requerimientos AS r','ser.requerimientoid','=','r.requerimientoid')
			->leftJoin('solicitudesemision AS se','ser.solicitudemisionid','=','se.solicitudemisionid')
			->where('se.usuarioid',$userID)
			->get();
        
    $asignacionRequerimientos = DB::table('solicitudasignacionrequerimientos AS sar')
			->select('sar.archivo','r.nombre', 'sar.solicitudasignacionrequerimientoid')
			->leftJoin('requerimientos AS r','sar.requerimientoid','=','r.requerimientoid')
			->leftJoin('solicitudasignacion AS sa','sa.solicitudasignacionid','=','sar.solicitudasignacionid')
			->where('sa.usuarioid',$id)
			->get();
    
    
    return View::make('usuarios/perfil')
      ->with('contingentes', $contingentes)
      ->with('requerimientos', $requerimientos)
      ->with('emisionRequerimientos', $emisionRequerimientos)
      ->with('asignacionRequerimientos', $asignacionRequerimientos)
      ->with('usuario', $datos);
    
  }
}