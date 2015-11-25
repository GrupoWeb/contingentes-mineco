<?php

class usuariosextraController extends crudController {

	public function __construct() {
    //consulta de datos db
  	$empresaid  = Auth::user()->empresaid;
  	$empresa    = DB::table('empresas')->where('empresaid', $empresaid)->pluck('razonsocial');
  	$rolempresa = Config::get('contingentes.rolempresa');

    //funcion de exportar .xls
  	Crud::setExport(false);
    //titulo catalogo
    Crud::setTitulo('Usuarios de '.$empresa);
    //conexion tabla db
    Crud::setTablaId('usuarioid');
    Crud::setTabla('authusuarios');

    Crud::setWhere('empresaid', $empresaid);

    Crud::setHidden(array('campo'=>'rolid','valor'=>reset($rolempresa)));
    Crud::setHidden(array('campo'=>'empresaid','valor'=>$empresaid));

    //Definicion de campos enlazado con conexion DB
    Crud::setCampo(array('nombre'=>'Nombre','campo'=>'authusuarios.nombre','reglas' => array('notEmpty'),'reglasmensaje'=>'El nombre es requerido'));
    Crud::setCampo(array('nombre'=>'Email','campo'=>'email','reglas' => array('notEmpty','email'),'reglasmensaje'=>'El email es requerido y debe ser valido'));
    Crud::setCampo(array('nombre'=>'Creado','campo'=>'authusuarios.created_at','tipo'=>'datetime','editable'=>false));
    Crud::setCampo(array('nombre'=>'Activo','campo'=>'authusuarios.activo','tipo'=>'bool'));
    Crud::setCampo(array('nombre'=>'Contraseña','campo'=>'password','tipo'=>'password','show'=>false));

    //permisos usuario de cancerbero
    Crud::setPermisos(Cancerbero::tienePermisosCrud('usuariosextra'));
  }
}
