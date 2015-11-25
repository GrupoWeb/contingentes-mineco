<?php

class usuarioswebserviceController extends crudController {
  public function __construct() {
    //tiulo catalogo
    Crud::setTitulo('Usuarios Webservice');
    //conexion db
    Crud::setTablaId('usuarioid');
    Crud::setTabla('authwebservice');

    //Definicion de campos enlazado con conexion DB
    Crud::setCampo(array('nombre'=>'Nombre','campo'=>'nombre','reglas' => array('notEmpty'),'reglasmensaje'=>'El nombre es requerido'));
    Crud::setCampo(array('nombre'=>'Email','campo'=>'email','reglas' => array('notEmpty','email'),'reglasmensaje'=>'El email es requerido y debe ser valido'));
    Crud::setCampo(array('nombre'=>'Creado','campo'=>'created_at','tipo'=>'datetime','editable'=>false));
    Crud::setCampo(array('nombre'=>'Activo','campo'=>'activo','tipo'=>'bool'));
    Crud::setCampo(array('nombre'=>'Contraseña','campo'=>'password','tipo'=>'password','show'=>false));
    Crud::setPermisos(array('edit'=>true,'delete'=>true,'add'=>true));
    //Crud::setPermisos(Cancerbero::tienePermisosCrud('usuarioswebservice'));
  }
}