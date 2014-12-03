<?php

class tratadosController extends crudController {
	
	public function __construct() {
		Crud::setExport(true); 
		Crud::setTitulo('Tratados');
		Crud::setTablaId('tratadoid');
		Crud::setTabla('tratados');

		
	 	Crud::setCampo(array('nombre'=>'Nombre','campo'=>'nombre'));
	 	Crud::setCampo(array('nombre'=>'Nombre Corto','campo'=>'nombrecorto'));
	 	Crud::setCampo(array('nombre'=>'Tipo','campo'=>'tipo', 'tipo'=>'enum', 'enumarray'=>array('Importación'=>'Importación', 'Exportación'=>'Exportación'))); //NO ALMACENA EL VALOR DEL ENUM
	 	Crud::setCampo(array('nombre'=>'Activo','campo'=>'activo', 'tipo'=>'bool'));
	 
	 	Crud::setPermisos(Cancerbero::tienePermisosCrud('tratados'));
	}
	
}