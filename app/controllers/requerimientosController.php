<?php
class requerimientosController extends crudController {

	public function __construct() {
		Crud::setExport(true);
		Crud::setTitulo('Requerimientos');
		Crud::setTabla('requerimientos');
		Crud::setTablaId('requerimientoid');

		Crud::setCampo(array('nombre'=>'Nombre','campo'=>'nombre','reglas' => array('notEmpty'), 'reglasmensaje'=>'El nombre es requerido', 'tipo'=>'string'));
		Crud::setCampo(array('nombre'=>'Activo','campo'=>'activo','tipo'=>'bool'));
		
		Crud::setPermisos(Cancerbero::tienePermisosCrud('requerimientos'));
	}

	public function getProductos($id, $tipo) {
		return Response::json(Productorequerimiento::getRequerimientos(Crypt::decrypt($id), $tipo));
	}
}
