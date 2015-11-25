<?php

class contingentepartidaController extends crudController {
	
	public function __construct() {
		//captura id y consulta db
		$id     = Crypt::decrypt(Input::get('contingente'));
		$nombre = Contingente::getNombre($id);

		//funcion exporta .xls
		Crud::setExport(true);
		//desactiva buscador
		Crud::setSearch(false); 
		//titulo de catalogo
		Crud::setTitulo($nombre->nombre.' - Partidas Arancelarias');

		//conexion db
		Crud::setTablaId('partidaid');
		Crud::setTabla('contingentepartidas');

		//consulta segun id
		Crud::setWhere('contingenteid', $id);
		//definicion de campos con la conexion de la tabla
		Crud::setCampo(array('nombre'=>'Nombre','campo'=>'nombre','tipo'=>'string','reglas' => array('notEmpty'), 'reglasmensaje'=>'El nombre es requerido'));
		Crud::setCampo(array('nombre'=>'Partida','campo'=>'partida','tipo'=>'string','reglas' => array('notEmpty'), 'reglasmensaje'=>'La partida es requerida'));
		Crud::setCampo(array('nombre'=>'Activa','campo'=>'activa','tipo'=>'bool'));
	
		//conservar id 
		Crud::setHidden(array('campo'=>'contingenteid', 'valor'=>$id));
	 	
	 	//permisos cancerbero
	 	Crud::setPermisos(Cancerbero::tienePermisosCrud('contingentes'));
	}
}