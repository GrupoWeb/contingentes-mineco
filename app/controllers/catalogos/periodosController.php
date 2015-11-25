<?php
class periodosController extends crudController {

	public function __construct() {
		//funsion de exportar .xls
		Crud::setExport(false);
		//titulo para catalogo
		Crud::setTitulo('Per&iacute;odos & cuotas');
		//conexion db
		Crud::setTabla('periodos');
		Crud::setTablaId('periodoid');

		//relacion entre tablas
		Crud::setLeftJoin('contingentes AS c', 'c.contingenteid', '=', 'periodos.contingenteid'); 

		//obtiene datos de session 
		$tselected = Session::get('tselected');
		if($tselected <> 0) {
			Crud::setWhere('c.tratadoid', $tselected);
			Crud::setTitulo('Per&iacute;odos & cuotas - '.Tratado::getNombre($tselected));
		}

		//definicion de campos con datos de la db
		Crud::setCampo(array('nombre'=>'Contingente','campo'=>"(SELECT CONCAT(t.nombrecorto,' - ', p.nombre) FROM tratados t, productos p, contingentes c2 WHERE p.productoid=c2.productoid AND t.tratadoid = c2.tratadoid AND c2.contingenteid = c.contingenteid)",'tipo'=>'combobox',
			'query'=>"SELECT (SELECT CONCAT(t.nombrecorto,' - ', p.nombre) FROM tratados t, productos p, contingentes c2 WHERE p.productoid=c2.productoid AND t.tratadoid = c2.tratadoid AND c2.contingenteid = con.contingenteid LIMIT 1) as nombre, contingenteid FROM contingentes con ORDER BY nombre",'combokey'=>'contingenteid','editable'=>false));
		Crud::setCampo(array('nombre'=>'Contingente','campo'=>"c.contingenteid",'tipo'=>'combobox',
			'query'=>"SELECT (SELECT CONCAT(t.nombrecorto,' - ', p.nombre) FROM tratados t, productos p, contingentes c2 WHERE p.productoid=c2.productoid AND t.tratadoid = c2.tratadoid AND c2.contingenteid = con.contingenteid LIMIT 1) as nombre, contingenteid FROM contingentes con ORDER BY nombre",'combokey'=>'contingenteid','editable'=>true,'show'=>false));
		Crud::setCampo(array('nombre'=>'Fecha Inicio','campo'=>'fechainicio','tipo'=>'date', 'default'=>'01/01/'.date('Y')));
		Crud::setCampo(array('nombre'=>'Fecha Fin','campo'=>'fechafin','tipo'=>'date', 'default'=>'31/12/'.date('Y')));
		Crud::setCampo(array('nombre'=>'Cuota total', 
			'campo'=>'(SELECT SUM(m.cantidad) FROM movimientos AS m 
				WHERE tipomovimientoid='. DB::table('tiposmovimiento')->where('nombre', 'Cuota')->pluck('tipomovimientoid') .' AND m.periodoid=periodos.periodoid)', 
			'editable'=>false,'tipo'=>'numeric','class'=>'text-right'));

		//botones estas para catalogo
		Crud::setBotonExtra(array('url'=>'periodosasignaciones?periodo={id}','icon'=>'glyphicon glyphicon-check','titulo'=>'Cuotas','class'=>'success'));
		Crud::setBotonExtra(array('url'=>'periodoconstancias?periodo={id}','icon'=>'glyphicon glyphicon-briefcase','titulo'=>'Constancias','class'=>'warning'));
		Crud::setBotonExtra(array('url'=>'periodospenalizaciones?periodo={id}','icon'=>'glyphicon glyphicon-ban-circle','titulo'=>'Penalizaciones y Devoluciones','class'=>'danger'));
		
		//mostrar datos en orden
		Crud::setOrderBy(array('columna'=>1,'direccion'=>'desc'));
		Crud::setOrderBy(array('columna'=>0,'direccion'=>'asc'));

		//permiso cancerbero
		Crud::setPermisos(Cancerbero::tienePermisosCrud('periodos'));
	}
}