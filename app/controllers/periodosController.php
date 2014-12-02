<?php

class periodosController extends crudController {
	
	public function __construct() {
		Crud::setExport(true); 
		Crud::setTitulo('Periodos');
		Crud::setTablaId('periodoid');
		Crud::setTabla('periodos');

		
	 	Crud::setCampo(array('nombre'=>'Nombre','campo'=>'nombre'));
	 	
	 	Crud::setPermisos(Cancerbero::tienePermisosCrud('periodos'));
	}
	
}