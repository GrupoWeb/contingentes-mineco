<?php

class historicoasignacionesController extends crudController {

	public function __construct() {
		Crud::setExport(true);
		Crud::setSearch(true);
		Crud::setTitulo('Histórico de asignaciones');

		Crud::setTabla('solicitudasignacion');
		Crud::setTablaId('solicitudasignacionid');

		Crud::setLeftJoin('authusuarios AS u', 'solicitudasignacion.usuarioid', '=', 'u.usuarioid');
		Crud::setLeftJoin('periodos AS pe', 'solicitudasignacion.periodoid', '=', 'pe.periodoid');
		Crud::setLeftJoin('contingentes AS c', 'pe.contingenteid', '=', 'c.contingenteid');
		Crud::setLeftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid');
		Crud::setLeftJoin('productos AS p', 'c.productoid', '=', 'p.productoid');

		$tselected = Session::get('tselected');
		if($tselected <> 0) {
			Crud::setWhere('t.tratadoid', $tselected);
			Crud::setTitulo('Histórico de asignaciones - '.Tratado::getNombre($tselected));
		}

		if(in_array(Auth::user()->rolid, Config::get('contingentes.rolempresa'))) {
			Crud::setWhere('u.email', Auth::user()->email);
		}

		Crud::setCampo(array('nombre'=>'Nombre','campo'=>'u.nombre'));
		Crud::setCampo(array('nombre'=>'Email','campo'=>'u.email'));
		Crud::setCampo(array('nombre'=>'Tratado','campo'=>'t.nombrecorto'));
		Crud::setCampo(array('nombre'=>'Producto','campo'=>'p.nombre'));
		Crud::setCampo(array('nombre'=>'Solicitado','campo'=>'solicitado','class'=>'text-right','tipo'=>'numeric','decimales'=>5));
		Crud::setCampo(array('nombre'=>'Asignado','campo'=>'asignado','class'=>'text-right','tipo'=>'numeric','decimales'=>5));
		Crud::setCampo(array('nombre'=>'Fecha de solicitud','campo'=>'solicitudasignacion.created_at', 'tipo'=>'datetime','class'=>'text-right'));
		Crud::setCampo(array('nombre'=>'Observaciones','campo'=>'observaciones'));
		Crud::setCampo(array('nombre'=>'Estado','campo'=>'estado','class'=>'text-right'));
		
		Crud::setPermisos(array('add'=>false,'edit'=>false,'delete'=>false));
	}
}
