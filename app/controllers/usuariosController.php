<?php

class usuariosController extends crudController {

  public function __construct() {
    Crud::setTitulo('Usuarios DACE');
    Crud::setTablaId('usuarioid');
    Crud::setTabla('authusuarios');


    Crud::setWhereRaw("rolid IN (". implode(',', Config::get('contingentes.roladmin')) .")");

    Crud::setCampo(array('nombre'=>'Nombre','campo'=>'authusuarios.nombre','reglas' => array('notEmpty'),'reglasmensaje'=>'El nombre es requerido'));
    Crud::setCampo(array('nombre'=>'Email','campo'=>'email','reglas' => array('notEmpty','email'),'reglasmensaje'=>'El email es requerido y debe ser valido'));
    Crud::setCampo(array('nombre'=>'Rol','campo'=>'rolid','tipo'=>'combobox','query'=>'SELECT nombre, rolid FROM authroles ORDER BY nombre','combokey'=>'rolid','show'=>false));
    Crud::setCampo(array('nombre'=>'Creado','campo'=>'authusuarios.created_at','tipo'=>'datetime','editable'=>false));
    Crud::setCampo(array('nombre'=>'Activo','campo'=>'authusuarios.activo','tipo'=>'bool'));
    Crud::setCampo(array('nombre'=>'Contraseña','campo'=>'password','tipo'=>'password','show'=>false));

    Crud::setPermisos(Cancerbero::tienePermisosCrud('usuarios'));
  }
}