<?php

class unidadesmedidaController extends crudController {

	public function __construct() {
		//funsion exportar .xls
		Crud::setExport(false); 
		//titulo catalogo
		Crud::setTitulo('Unidades de medida');
		//conexion db
		Crud::setTablaId('unidadmedidaid');
		Crud::setTabla('unidadesmedida');
		
		//definicion de campos con dato de la conexion
	 	Crud::setCampo(array('nombre'=>'Nombre','campo'=>'nombre'));
	 	Crud::setCampo(array('nombre'=>'Nombre corto','campo'=>'nombrecorto'));

	 	//permiso cancerbero
	 	Crud::setPermisos(Cancerbero::tienePermisosCrud('unidadesmedida'));
	}	
}
