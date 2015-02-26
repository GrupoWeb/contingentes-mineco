<?php

class historicoinscripcionesController extends crudController {

	public function __construct() {
		Crud::setExport(true);
		Crud::setSearch(true);
		Crud::setTitulo('Histórico de inscripciones');

		Crud::setTabla('solicitudinscripcioncontingentes');
		Crud::setTablaId('solicitudinscripcioncontingenteid');

		Crud::setLeftJoin('solicitudinscripciones AS si', 'solicitudinscripcioncontingentes.solicitudinscripcionid', '=', 'si.solicitudinscripcionid');
		Crud::setLeftJoin('contingentes AS c', 'solicitudinscripcioncontingentes.contingenteid', '=', 'c.contingenteid');
		Crud::setLeftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid');
		Crud::setLeftJoin('productos AS p', 'c.productoid', '=', 'p.productoid');

		Crud::setWhere('si.estado', '<>', 'Pendiente');

		$tselected = Session::get('tselected');
		if($tselected <> 0) {
			Crud::setWhere('t.tratadoid', $tselected);
			Crud::setTitulo('Histórico de inscripciones - '.Tratado::getNombre($tselected));
		}

		if(in_array(Auth::user()->rolid, Config::get('contingentes.rolempresa'))) {
			Crud::setWhere('si.email', Auth::user()->email);
		}

		Crud::setCampo(array('nombre'=>'Nombre','campo'=>'si.nombre'));
		Crud::setCampo(array('nombre'=>'Email','campo'=>'si.email'));
		Crud::setCampo(array('nombre'=>'Tratado','campo'=>'t.nombrecorto'));
		Crud::setCampo(array('nombre'=>'Producto','campo'=>'p.nombre'));
		Crud::setCampo(array('nombre'=>'Fecha de solicitud','campo'=>'si.created_at', 'tipo'=>'datetime','class'=>'text-right'));
		Crud::setCampo(array('nombre'=>'Observaciones','campo'=>'si.observaciones'));
		Crud::setCampo(array('nombre'=>'Estado','campo'=>'si.estado','class'=>'text-right'));
		
		Crud::setPermisos(array('add'=>false,'edit'=>false,'delete'=>false));
	}
}
