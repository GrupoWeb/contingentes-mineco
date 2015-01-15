<?php

class contingentepartidaController extends crudController {
	
	public function __construct() {
		$id     = Crypt::decrypt(Input::get('contingente'));
		$nombre = Contingente::getNombre($id);

		Crud::setExport(true);
		Crud::setSearch(false); 
		Crud::setTitulo($nombre->nombre.' - Partidas Arancelarias');
		Crud::setTablaId('partidaid');
		Crud::setTabla('contingentepartidas');

		Crud::setWhere('contingenteid', $id);

		Crud::setCampo(array('nombre'=>'Nombre','campo'=>'nombre','tipo'=>'string','reglas' => array('notEmpty'), 'reglasmensaje'=>'El nombre es requerido'));
		Crud::setCampo(array('nombre'=>'Partida','campo'=>'partida','tipo'=>'string','reglas' => array('notEmpty'), 'reglasmensaje'=>'La partida es requerida'));
		Crud::setCampo(array('nombre'=>'Activa','campo'=>'activa','tipo'=>'bool'));
	
		Crud::setHidden(array('campo'=>'contingenteid', 'valor'=>$id));
	 	
	 	Crud::setPermisos(Cancerbero::tienePermisosCrud('contingentes'));
	}
}