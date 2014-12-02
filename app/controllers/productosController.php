<?php

class productosController extends crudController {
	
	public function __construct() {
		Crud::setExport(true); 
		Crud::setTitulo('Productos');
		Crud::setTablaId('productoid');
		Crud::setTabla('productos');

		
	 	Crud::setCampo(array('nombre'=>'Nombre','campo'=>'nombre'));
	 	Crud::setPermisos(Cancerbero::tienePermisosCrud('productos'));
	}

	
}