<?php

class productosController extends crudController {
	
	public function __construct() {
		//funsion exportar .xls
		Crud::setExport(true); 
		//titulo catalogo
		Crud::setTitulo('Productos');
		//conexion db
		Crud::setTablaId('productoid');
		Crud::setTabla('productos');
		Crud::setLeftJoin('unidadesmedida AS u','u.unidadmedidaid','=','productos.unidadmedidaid');

		//definicion de campos con datos de db
	 	Crud::setCampo(array('nombre'=>'Nombre','campo'=>'productos.nombre'));
	 	Crud::setCampo(array('nombre'=>'Unidad de Medida','campo'=>'u.nombre','editable'=>false));

	 	Crud::setCampo(array('nombre'=>'Unidad de Medida',
	 						 'campo'=>'productos.unidadmedidaid' ,
	 						 'tipo'=>'combobox', 
	 						 'query'=>'SELECT  CONCAT(nombre,"-",nombrecorto), unidadmedidaid FROM  unidadesmedida', 
	 						 'combokey'=>'unidadmedidaid',
	 						 'show'=>false));

	 	//permiso cancerbero
	 	Crud::setPermisos(Cancerbero::tienePermisosCrud('productos'));
	}

	
}