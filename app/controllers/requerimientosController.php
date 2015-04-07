<?php
class requerimientosController extends crudController {

	public function __construct() {
		Crud::setExport(true);
		Crud::setTitulo('Requerimientos');
		Crud::setTabla('requerimientos');
		Crud::setTablaId('requerimientoid');

		Crud::setCampo(array('nombre'=>'Nombre','campo'=>'nombre','reglas' => array('notEmpty'), 'reglasmensaje'=>'El nombre es requerido', 'tipo'=>'string'));
				
		Crud::setPermisos(Cancerbero::tienePermisosCrud('requerimientos'));
	}

	public function getContingentes($id, $tipo) {
		$id             = Crypt::decrypt($id);
		$requerimientos = array();

		if(Auth::check())
			$requerimientos = Empresarequerimiento::getEmpresaRequerimientosIds();

		return Response::json(Contingenterequerimiento::getRequerimientos($id, $tipo, $requerimientos));
	}

	public function getVacio() {
		return View::make('requerimientos/vacio');
	}
}
