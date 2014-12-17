<?php

class contingentepartidaController extends crudController {
	
	public function __construct() {
		Crud::setExport(true); 
		Crud::setTitulo('Partidas Arancelarias');
		Crud::setTablaId('partidaid');
		Crud::setTabla('contingentepartidas');

		Crud::setCampo(array('nombre'=>'Nombre','campo'=>'nombre','tipo'=>'string','reglas' => array('notEmpty'), 'reglasmensaje'=>'El nombre es requerido'));
		Crud::setCampo(array('nombre'=>'Partida','campo'=>'partida','tipo'=>'string','reglas' => array('notEmpty'), 'reglasmensaje'=>'La partida es requerida'));
		
		Crud::setCampo(array('nombre'=>'Contingente','campo'=>"(SELECT CONCAT(t.nombrecorto,' - ', p.nombre) FROM tratados t, productos p, contingentes c2 WHERE p.productoid=c2.productoid AND t.tratadoid = c2.tratadoid AND c2.contingenteid = contingentepartidas.contingenteid)",'tipo'=>'combobox',
			'query'=>"SELECT (SELECT CONCAT(t.nombrecorto,' - ', p.nombre) FROM tratados t, productos p, contingentes c2 WHERE p.productoid=c2.productoid AND t.tratadoid = c2.tratadoid AND c2.contingenteid = con.contingenteid LIMIT 1) as nombre, contingenteid FROM contingentes con ORDER BY nombre",'combokey'=>'contingenteid','editable'=>false));
		
		Crud::setCampo(array('nombre'=>'Contingente','campo'=>"c.contingenteid",'tipo'=>'combobox',
			'query'=>"SELECT (SELECT CONCAT(t.nombrecorto,' - ', p.nombre) FROM tratados t, productos p, contingentes c2 WHERE p.productoid=c2.productoid AND t.tratadoid = c2.tratadoid AND c2.contingenteid = con.contingenteid LIMIT 1) as nombre, contingenteid FROM contingentes con ORDER BY nombre",'combokey'=>'contingenteid','editable'=>true,'show'=>false));
		Crud::setCampo(array('nombre'=>'Activa','campo'=>'activa','tipo'=>'bool'));
	
		/*Crud::setCampo(array('nombre'=>'Producto','campo'=>'(SELECT nombre FROM productos WHERE productoid=contingentes.productoid)', 'editable'=>false, 'show'=>true));
	 	Crud::setCampo(array('nombre'=>'Tratado','campo'=>'(SELECT nombrecorto FROM tratados WHERE tratadoid=contingentes.tratadoid)', 'editable'=>false, 'show'=>true));
		Crud::setCampo(array('nombre' =>'Producto', 'campo'=>'productoid', 'tipo'=>'combobox', 'query'=>'SELECT nombre, productoid FROM productos', 'combokey'=>'productoid', 'editable'=>true, 'show'=>false));
	 	Crud::setCampo(array('nombre' =>'Tratado', 'campo'=>'tratadoid', 'tipo'=>'combobox', 'query'=>'SELECT nombrecorto as nombre, tratadoid FROM tratados', 'combokey'=>'tratadoid', 'editable'=>true, 'show'=>false));

	 	Crud::setBotonExtra(array('url'=>'contingente/requerimientos/','icon'=>'glyphicon glyphicon-list-alt','titulo'=>'Ver detalle'));*/
	 	
	 	Crud::setPermisos(Cancerbero::tienePermisosCrud('contingentes'));
	}
}