<?php

class contingentesController extends crudController {
	
	public function __construct() {
		Crud::setExport(true); 
		Crud::setTitulo('Contingentes');
		Crud::setTablaId('contingenteid');
		Crud::setTabla('contingentes');
	
		Crud::setCampo(array('nombre'=>'Producto','campo'=>'(SELECT nombre FROM productos WHERE productoid=contingentes.productoid)', 'editable'=>false, 'show'=>true));
	 	Crud::setCampo(array('nombre'=>'Tratado','campo'=>'(SELECT nombre FROM tratados WHERE tratadoid=contingentes.tratadoid)', 'editable'=>false, 'show'=>true));
		Crud::setCampo(array('nombre' =>'Producto', 'campo'=>'productoid', 'tipo'=>'combobox', 'query'=>'SELECT nombre, productoid FROM productos', 'combokey'=>'productoid', 'editable'=>true, 'show'=>false));
	 	Crud::setCampo(array('nombre' =>'Tratado', 'campo'=>'tratadoid', 'tipo'=>'combobox', 'query'=>'SELECT nombre, tratadoid FROM tratados', 'combokey'=>'tratadoid', 'editable'=>true, 'show'=>false));

	 	Crud::setBotonExtra(array('url'=>'contingente/requerimientos/','icon'=>'glyphicon glyphicon-list-alt','titulo'=>'Ver detalle'));
	 	
	 	Crud::setPermisos(Cancerbero::tienePermisosCrud('contingentes'));
	}

	public function asignarrequerimientos($id){
		  return View::make('contingentes/asignarrequerimientos');
	}	

	public function getSaldo($contingenteid) {
		$disponible             = DB::select(DB::raw('SELECT getSaldo('.$contingenteid.','.Auth::id().') AS disponible'));
		$response['disponible'] = $disponible[0]->disponible;
		$response['unidad']     = Contingente::getUnidadMedida($contingenteid);

		return Response::json($response);
	}
}