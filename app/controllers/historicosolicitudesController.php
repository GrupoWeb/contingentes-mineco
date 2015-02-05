<?php

class historicosolicitudesController extends crudController {

	public function __construct() {
		Crud::setExport(false);
		Crud::setSearch(false);
		Crud::setTitulo('Histórico de solicitudes');
		Crud::setTabla('solicitudesemision');
		Crud::setTablaId('solicitudemisionid');
		
		Crud::setLeftJoin('authusuarios AS u', 'solicitudesemision.usuarioid', '=', 'u.usuarioid');
		Crud::setLeftJoin('periodos AS p', 'solicitudesemision.periodoid', '=', 'p.periodoid');
		Crud::setLeftJoin('contingentes AS c', 'p.contingenteid', '=', 'c.contingenteid');
		Crud::setLeftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid');
		Crud::setLeftJoin('productos AS d', 'c.productoid', '=', 'd.productoid');

		$tselected = Session::get('tselected');
		if($tselected <> 0) {
			Crud::setWhere('c.tratadoid', $tselected);
			Crud::setTitulo('Histórico de solicitudes - '.Tratado::getNombre($tselected));
		}

		Crud::setCampo(array('nombre'=>'Usuario','campo'=>'u.nombre'));
		Crud::setCampo(array('nombre'=>'Tratado','campo'=>'t.nombrecorto'));
		Crud::setCampo(array('nombre'=>'Producto','campo'=>'d.nombre','class'=>'text-right'));
		Crud::setCampo(array('nombre'=>'Monto Solicitado','campo'=>'solicitado','tipo'=>'numeric','class'=>'text-right'));
		Crud::setCampo(array('nombre'=>'Fecha de solicitud','campo'=>'solicitudesemision.created_at', 'tipo'=>'datetime','class'=>'text-right'));
		Crud::setCampo(array('nombre'=>'Estado','campo'=>'estado'));
		Crud::setCampo(array('nombre'=>'Observaciones','campo'=>'observaciones'));
		
		Crud::setPermisos(array('add'=>false,'edit'=>false,'delete'=>false));
	}
}