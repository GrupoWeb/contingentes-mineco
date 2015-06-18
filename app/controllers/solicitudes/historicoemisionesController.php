<?php

class historicoemisionesController extends crudController {

	public function __construct() {
		Crud::setExport(true);
		Crud::setSearch(true);
		Crud::setTitulo('Histórico de emisiones');

		Crud::setTabla('solicitudesemision');
		Crud::setTablaId('solicitudemisionid');

		Crud::setLeftJoin('authusuarios AS u', 'solicitudesemision.usuarioid', '=', 'u.usuarioid');
		Crud::setLeftJoin('periodos AS pe', 'solicitudesemision.periodoid', '=', 'pe.periodoid');
		Crud::setLeftJoin('contingentes AS c', 'pe.contingenteid', '=', 'c.contingenteid');
		Crud::setLeftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid');
		Crud::setLeftJoin('productos AS p', 'c.productoid', '=', 'p.productoid');

		$tselected = Session::get('tselected');
		if($tselected <> 0) {
			Crud::setWhere('t.tratadoid', $tselected);
			Crud::setTitulo('Histórico de emisiones - '.Tratado::getNombre($tselected));
		}

		if(in_array(Auth::user()->rolid, Config::get('contingentes.rolempresa'))) {
			Crud::setWhere('u.empresaid', Auth::user()->empresaid);
		}

		if(Input::has('estado')) {
			Crud::setWhere('estado',Input::get('estado'));
		}

		Crud::setCampo(array('nombre'=>'Nombre','campo'=>'u.nombre'));
		Crud::setCampo(array('nombre'=>'Email','campo'=>'u.email'));
		Crud::setCampo(array('nombre'=>'Tratado','campo'=>'t.nombrecorto'));
		Crud::setCampo(array('nombre'=>'Producto','campo'=>'p.nombre'));
		Crud::setCampo(array('nombre'=>'Solicitado','campo'=>'solicitado','class'=>'text-right','tipo'=>'numeric','decimales'=>5));
		Crud::setCampo(array('nombre'=>'Emitido','campo'=>'emitido','class'=>'text-right','tipo'=>'numeric','decimales'=>5));
		Crud::setCampo(array('nombre'=>'Fecha de solicitud','campo'=>'solicitudesemision.created_at', 'tipo'=>'datetime','class'=>'text-right'));
		Crud::setCampo(array('nombre'=>'Observaciones','campo'=>'observaciones'));
		Crud::setCampo(array('nombre'=>'Estado','campo'=>'estado'));

		Crud::setBotonExtra(array('url'=>'/historicosolicitudes/emision/archivos/{id}','icon'=>'fa fa-file-o','titulo'=>'Archivos adjuntos','class'=>'primary', 'target'=>'_blank'));
		
		Crud::setPermisos(array('add'=>false,'edit'=>false,'delete'=>false));
	}

	public function archivos($id) {
		$id = Crypt::decrypt($id);

		return View::make('historico.archivos')
			->with('titulo', 'Archivos adjuntos para solicitud de emisión')
			->with('solicitud', Solicitudesemision::getSolicitud($id))
			->with('archivos', Solicitudemisionrequerimiento::getArchivos($id));
	}	
}
