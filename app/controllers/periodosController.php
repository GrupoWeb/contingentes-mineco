<?php
class periodosController extends crudController {

	public function __construct() {

		Crud::setExport(false);
		Crud::setTitulo('Per&iacute;odos');
		Crud::setTabla('periodos');
		Crud::setTablaId('periodoid');

		Crud::setLeftJoin('contingentes AS c', 'c.contingenteid', '=', 'periodos.contingenteid'); 

		Crud::setCampo(array('nombre'=>'Contingente','campo'=>"(SELECT CONCAT(t.nombre,' - ', p.nombre) FROM tratados t, productos p, contingentes c2 WHERE p.productoid=c2.productoid AND t.tratadoid = c2.tratadoid AND c2.contingenteid = c.contingenteid)",'tipo'=>'combobox',
			'query'=>"SELECT (SELECT CONCAT(t.nombre,' - ', p.nombre) FROM tratados t, productos p, contingentes c2 WHERE p.productoid=c2.productoid AND t.tratadoid = c2.tratadoid) as nombre, contingenteid FROM contingentes ORDER BY nombre",'combokey'=>'contingenteid','editable'=>false));

		Crud::setCampo(array('nombre'=>'Contingente','campo'=>"c.contingenteid",'tipo'=>'combobox',
			'query'=>"SELECT (SELECT CONCAT(t.nombre,' - ', p.nombre) FROM tratados t, productos p, contingentes c2 WHERE p.productoid=c2.productoid AND t.tratadoid = c2.tratadoid) as nombre, contingenteid FROM contingentes ORDER BY nombre",'combokey'=>'contingenteid','editable'=>true,'show'=>false));

		Crud::setCampo(array('nombre'=>'Nombre','campo'=>'periodos.nombre','tipo'=>'string','reglas' => array('notEmpty'), 'reglasmensaje'=>'El nombre es requerido' ));
		Crud::setCampo(array('nombre'=>'Fechainicio','campo'=>'periodos.fechainicio','tipo'=>'date'));
		Crud::setCampo(array('nombre'=>'Fechafin','campo'=>'periodos.fechafin','tipo'=>'date'));
		
		Crud::setPermisos(Cancerbero::tienePermisosCrud('periodos'));
	}

	public function edit($id) {
		return Crud::create($id);
	}
}