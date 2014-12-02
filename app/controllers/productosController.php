<?php

class productosController extends crudController {
	
	public function __construct() {
		Crud::setExport(true); 
		Crud::setTitulo('Productos');
		Crud::setTablaId('productoid');
		Crud::setTabla('productos');

		
	 	Crud::setCampo(array('nombre'=>'Nombre','campo'=>'nombre'));
	 	
	 	Crud::setCampo(array('nombre'=>'Unidad de Medida',
	 						 'campo'=>'productos.unidadmedidaid' ,
	 						 'tipo'=>'combobox', 
	 						 'query'=>'SELECT  CONCAT(nombre,"-",nombrecorto), unidadmedidaid FROM  unidadesmedida', 
	 						 'combokey'=>'unidadmedidaid',
	 						 'show'=>false));

	 	Crud::setPermisos(Cancerbero::tienePermisosCrud('productos'));
	}

	
}