<?php

class catalogonoticiasController extends crudController {
	
	public function __construct() {
		//funcion de exportar .xls
		Crud::setExport(true);
		//titulo catalogo 
		Crud::setTitulo('Noticias');
		//conexion db tabla
		Crud::setTablaId('noticiaid');
		Crud::setTabla('noticias');
		
		//definicio de campos con la conexion db
	 	Crud::setCampo(array('nombre'=>'Titulo','campo'=>'titulo','reglas'=>['notempty'],'reglasmensaje'=>'El campo titulo es requerido'));
	 	Crud::setCampo(array('nombre'=>'Contenido','campo'=>'contenido','tipo'=>'textarea','reglas'=>['notempty'],'reglasmensaje'=>'El campo contenido es requerido'));
	 	Crud::setCampo(array('nombre'=>'Imágen','campo'=>'imagen','tipo'=>'image','filepath'=>'/noticias/'));

	 	//permiso de cancerbero
	 	Crud::setPermisos(Cancerbero::tienePermisosCrud('catalogonoticias'));
	}	
}