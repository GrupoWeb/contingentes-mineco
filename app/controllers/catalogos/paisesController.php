<?php

class paisesController extends crudController {
	
	public function __construct() {
		Crud::setExport(true); 
		Crud::setTitulo('Países');
		Crud::setTablaId('paisid');
		Crud::setTabla('paises');
		
	 	Crud::setCampo(array('nombre'=>'Nombre','campo'=>'nombre'));

	 	Crud::setPermisos(Cancerbero::tienePermisosCrud('paises'));
	}	
}