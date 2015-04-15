<?php

class usuariosextraController extends crudController {

	public function __construct() {
		$empresaid  = Auth::user()->empresaid;
		$empresa    = DB::table('empresas')->where('empresaid', $empresaid)->pluck('razonsocial');
		$rolempresa = Config::get('contingentes.rolempresa');

		Crud::setExport(false);
    Crud::setTitulo('Usuarios de '.$empresa);
    Crud::setTablaId('usuarioid');
    Crud::setTabla('authusuarios');

    Crud::setWhere('empresaid', $empresaid);

    Crud::setHidden(array('campo'=>'rolid','valor'=>reset($rolempresa)));
    Crud::setHidden(array('campo'=>'empresaid','valor'=>$empresaid));

    Crud::setCampo(array('nombre'=>'Nombre','campo'=>'authusuarios.nombre','reglas' => array('notEmpty'),'reglasmensaje'=>'El nombre es requerido'));
    Crud::setCampo(array('nombre'=>'Email','campo'=>'email','reglas' => array('notEmpty','email'),'reglasmensaje'=>'El email es requerido y debe ser valido'));
    Crud::setCampo(array('nombre'=>'Creado','campo'=>'authusuarios.created_at','tipo'=>'datetime','editable'=>false));
    Crud::setCampo(array('nombre'=>'Activo','campo'=>'authusuarios.activo','tipo'=>'bool'));
    Crud::setCampo(array('nombre'=>'Contraseña','campo'=>'password','tipo'=>'password','show'=>false));

    Crud::setPermisos(Cancerbero::tienePermisosCrud('usuariosextra'));
  }
}
