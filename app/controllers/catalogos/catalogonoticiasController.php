<?php

class catalogonoticiasController extends crudController {
	
	public function __construct() {
		Crud::setExport(true); 
		Crud::setTitulo('Noticias');
		Crud::setTablaId('noticiaid');
		Crud::setTabla('noticias');
		
	 	Crud::setCampo(array('nombre'=>'Titulo','campo'=>'titulo','reglas'=>['notempty'],'reglasmensaje'=>'El campo titulo es requerido'));
	 	Crud::setCampo(array('nombre'=>'Contenido','campo'=>'contenido','tipo'=>'textarea','reglas'=>['notempty'],'reglasmensaje'=>'El campo contenido es requerido'));
	 	Crud::setCampo(array('nombre'=>'Imágen','campo'=>'imagen','tipo'=>'image','filepath'=>'/noticias/'));

	 	Crud::setPermisos(Cancerbero::tienePermisosCrud('catalogonoticias'));
	}	
}