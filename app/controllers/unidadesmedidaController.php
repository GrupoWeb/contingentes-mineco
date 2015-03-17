<?php

class unidadesmedidaController extends crudController {

	public function __construct() {
		Crud::setExport(false); 
		Crud::setTitulo('Unidades de medida');
		Crud::setTablaId('unidadmedidaid');
		Crud::setTabla('unidadesmedida');
		
	 	Crud::setCampo(array('nombre'=>'Nombre','campo'=>'nombre'));
	 	Crud::setCampo(array('nombre'=>'Nombre corto','campo'=>'nombrecorto'));

	 	Crud::setPermisos(Cancerbero::tienePermisosCrud('unidadesmedida'));
	}	
}
