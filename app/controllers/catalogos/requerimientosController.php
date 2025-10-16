<?php
class requerimientosController extends crudController {

	public function __construct() {
		//funsion exportar .xls
		Crud::setExport(true);
		//titulo catalogo
		Crud::setTitulo('Requerimientos');
		//conexion db
		Crud::setTabla('requerimientos');
		Crud::setTablaId('requerimientoid');

		//definicio de campos con datos de la conexion
		Crud::setCampo(array('nombre'=>'Nombre','campo'=>'nombre','reglas' => array('notEmpty'), 'reglasmensaje'=>'El nombre es requerido', 'tipo'=>'string'));
		
		//permisos cancerbero	
		Crud::setPermisos(Cancerbero::tienePermisosCrud('requerimientos'));
	}

	public function getContingentes($id, $tipo) {
		try {
			//captura id
			$id             = Crypt::decrypt($id);
		} catch(\Exception $e) {
			//muestra error
			$id                      = -1;
			$response['codigoerror'] = 3;
			$response['error']       = 'Usuario/contingente/requerimiento invalido';
		}

		
		$requerimientos = array();

		

		//verifica $requerimientos
		// if(Auth::check())
		// 	$requerimientos = Empresarequerimiento::getEmpresaRequerimientosIds();

			if (Auth::check()) {
				$requerimientos = Empresarequerimiento::getEmpresaRequerimientosIds();
				// }else{
					// 	return "Usuario no autenticado";
				}
			
				return Response::json(Contingenterequerimiento::getRequerimientos($id, $tipo, $requerimientos));
			
		//mada a json los datos
		// return Response::json(Contingenterequerimiento::getRequerimientos($id, $tipo, $requerimientos));
	}

	public function getVacio() {
		//retorna vista 
		return View::make('requerimientos/vacio');
	}
}
