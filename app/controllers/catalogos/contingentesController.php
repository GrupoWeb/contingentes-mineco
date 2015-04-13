<?php

class contingentesController extends crudController {
	
	public function __construct() {
		$id = Crypt::decrypt(Input::get('tratado'));	

		Crud::setExport(true); 
		Crud::setTitulo(Tratado::getNombre($id).' - Contingentes');
		Crud::setTablaId('contingenteid');
		Crud::setTabla('contingentes');

		Crud::setLeftJoin('productos AS p', 'contingentes.productoid', '=', 'p.productoid');
		Crud::setLeftJoin('tipotratados AS t', 'contingentes.tipotratadoid', '=', 't.tipotratadoid');
		Crud::setLeftJoin('unidadesmedida AS u', 'contingentes.unidadmedidaid', '=', 'u.unidadmedidaid');
		Crud::setLeftJoin('plantillascertificados AS pc', 'contingentes.plantillaid', '=', 'pc.plantillaid');
		Crud::setWhere('tratadoid', $id);
	
		Crud::setCampo(array('nombre'=>'Producto','campo'=>'p.nombre', 'editable'=>false));
		Crud::setCampo(array('nombre'=>'Tipo','campo'=>'t.nombre', 'editable'=>false));
		Crud::setCampo(array('nombre'=>'Unidad de medida','campo'=>'u.nombrecorto', 'editable'=>false));
		Crud::setCampo(array('nombre'=>'Plantilla','campo'=>'pc.nombre', 'editable'=>false));
		Crud::setCampo(array('nombre'=>'Producto', 'campo'=>'p.productoid', 'tipo'=>'combobox', 'query'=>'SELECT nombre, productoid FROM productos ORDER BY nombre', 'combokey'=>'productoid', 'editable'=>true, 'show'=>false));
		Crud::setCampo(array('nombre'=>'Unidad de medida', 'campo'=>'unidadmedidaid', 'tipo'=>'combobox', 'query'=>'SELECT CONCAT(nombre," (",nombrecorto,")") AS nombre, unidadmedidaid FROM unidadesmedida ORDER BY nombre', 'combokey'=>'unidadmedidaid', 'editable'=>true, 'show'=>false));
	 	Crud::setCampo(array('nombre'=>'Tipo tratado', 'campo'=>'tipotratadoid', 'tipo'=>'combobox', 'query'=>'SELECT nombre, tipotratadoid FROM tipotratados', 'combokey'=>'tipotratadoid', 'editable'=>true, 'show'=>false));
	 	Crud::setCampo(array('nombre'=>'Plantilla certificado', 'campo'=>'plantillaid', 'tipo'=>'combobox', 'query'=>'SELECT nombre, plantillaid FROM plantillascertificados', 'combokey'=>'plantillaid', 'editable'=>true, 'show'=>false));
	 	Crud::setCampo(array('nombre'=>'Requiere Asignación', 'campo'=>'t.asignacion', 'tipo'=>'bool','editable'=>false));	
	 	Crud::setCampo(array('nombre'=>'Texto certificado','campo'=>'textocertificado', 'tipo'=>'textarea', 'show'=>false, 'reglas'=>array('notEmpty'),'reglasmensaje'=>'El texto es requerido'));

	 	Crud::setBotonExtra(array('url'=>'contingente/requerimientos/{id}?tratado='.Input::get('tratado'),'icon'=>'glyphicon glyphicon-list-alt','titulo'=>'Requerimientos'));
	 	Crud::setBotonExtra(array('url'=>'partidasarancelarias?contingente={id}','icon'=>'glyphicon glyphicon-th','titulo'=>'Fracciones arancelarias', 'class'=>'success'));

	 	Crud::setHidden(array('campo'=>'tratadoid', 'valor'=>$id));
	 	
	 	Crud::setPermisos(Cancerbero::tienePermisosCrud('contingentes'));
	}

	public function getSaldo($contingenteid) {
		$disponible             = DB::select(DB::raw('SELECT getSaldo('.Crypt::decrypt($contingenteid).','.Auth::id().') AS disponible'));
		$response['disponible'] = $disponible[0]->disponible;
		$response['unidad']     = Contingente::getUnidadMedida($contingenteid);

		return Response::json($response);
	}

	public function getSaldoAsignacion($contingenteid) {
		$disponible             = DB::select(DB::raw('SELECT getSaldoAsignacion('.Crypt::decrypt($contingenteid).','.Auth::id().') AS disponible'));
		$response['disponible'] = $disponible[0]->disponible;
		$response['unidad']     = Contingente::getUnidadMedida($contingenteid);

		return Response::json($response);
	}
}