<?php
class periodosController extends crudController {

	public function __construct() {
		Crud::setExport(false);
		Crud::setTitulo('Per&iacute;odos & coutas');
		Crud::setTabla('periodos');
		Crud::setTablaId('periodoid');

		Crud::setLeftJoin('contingentes AS c', 'c.contingenteid', '=', 'periodos.contingenteid'); 

		Crud::setCampo(array('nombre'=>'Nombre','campo'=>'periodos.nombre','tipo'=>'string','reglas' => array('notEmpty'), 'reglasmensaje'=>'El nombre es requerido' ));
		Crud::setCampo(array('nombre'=>'Contingente','campo'=>"(SELECT CONCAT(t.nombrecorto,' - ', p.nombre) FROM tratados t, productos p, contingentes c2 WHERE p.productoid=c2.productoid AND t.tratadoid = c2.tratadoid AND c2.contingenteid = c.contingenteid)",'tipo'=>'combobox',
			'query'=>"SELECT (SELECT CONCAT(t.nombrecorto,' - ', p.nombre) FROM tratados t, productos p, contingentes c2 WHERE p.productoid=c2.productoid AND t.tratadoid = c2.tratadoid AND c2.contingenteid = con.contingenteid LIMIT 1) as nombre, contingenteid FROM contingentes con ORDER BY nombre",'combokey'=>'contingenteid','editable'=>false));
		Crud::setCampo(array('nombre'=>'Contingente','campo'=>"c.contingenteid",'tipo'=>'combobox',
			'query'=>"SELECT (SELECT CONCAT(t.nombrecorto,' - ', p.nombre) FROM tratados t, productos p, contingentes c2 WHERE p.productoid=c2.productoid AND t.tratadoid = c2.tratadoid AND c2.contingenteid = con.contingenteid LIMIT 1) as nombre, contingenteid FROM contingentes con ORDER BY nombre",'combokey'=>'contingenteid','editable'=>true,'show'=>false));
		Crud::setCampo(array('nombre'=>'Fecha Inicio','campo'=>'fechainicio','tipo'=>'date', 'default'=>'01/01/'.date('Y')));
		Crud::setCampo(array('nombre'=>'Fecha Fin','campo'=>'fechafin','tipo'=>'date', 'default'=>'31/12/'.date('Y')));
		Crud::setCampo(array('nombre'=>'Cuota total', 
			'campo'=>'(SELECT SUM(m.cantidad) FROM movimientos AS m 
				WHERE certificadoid IS NULL AND cantidad>0 AND m.periodoid=periodos.periodoid)', 
			'editable'=>false,'tipo'=>'numeric','class'=>'text-right'));

		Crud::setBotonExtra(array('url'=>'periodosasignaciones?periodo={id}','icon'=>'glyphicon glyphicon-check','titulo'=>'Cuotas','class'=>'success'));
		
		Crud::setPermisos(Cancerbero::tienePermisosCrud('periodos'));
	}
}