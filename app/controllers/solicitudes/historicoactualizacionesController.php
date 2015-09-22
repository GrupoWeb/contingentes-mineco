<?php

class historicoactualizacionesController extends crudController {

	public function __construct() {
		Crud::setExport(true);
		Crud::setSearch(true);
		Crud::setTitulo('Histórico de actualizaciones');

		Crud::setTabla('solicitudactualizacion');
		Crud::setTablaId('actualizacionid');

		Crud::setLeftJoin('authusuarios AS u', 'solicitudactualizacion.usuarioid', '=', 'u.usuarioid');
		Crud::setLeftJoin('empresas AS e', 'solicitudactualizacion.empresaid', '=', 'e.empresaid');

		if(in_array(Auth::user()->rolid, Config::get('contingentes.rolempresa'))) {
			Crud::setWhere('empresaid', Auth::user()->empresaid);
		}

		Crud::setCampo(array('nombre'=>'Nombre','campo'=>'u.nombre'));
		Crud::setCampo(array('nombre'=>'Empresa','campo'=>'e.razonsocial'));
		Crud::setCampo(array('nombre'=>'NIT','campo'=>'e.nit'));
		Crud::setCampo(array('nombre'=>'Fecha','campo'=>'solicitudactualizacion.created_at','tipo'=>'datetime'));
		Crud::setCampo(array('nombre'=>'Observaciones','campo'=>'observaciones'));
		Crud::setCampo(array('nombre'=>'Estado','campo'=>'estado'));

		Crud::setBotonExtra(array('url'=>'/historicosolicitudes/actualizacion/archivos/{id}','icon'=>'fa fa-file-o','titulo'=>'Archivos adjuntos','class'=>'primary', 'target'=>'_blank'));
		
		Crud::setPermisos(array('add'=>false,'edit'=>false,'delete'=>false));
	}

	public function archivos($id) {
		$id = Crypt::decrypt($id);
		
		return View::make('historico.archivosactualizacion')
			->with('titulo', 'Archivos adjuntos para solicitud de actualizacion')
			->with('solicitud', Solictudactualizacion::getSolicitud($id))
			->with('archivos', Solictudactualizacionarchivo::getArchivosActualizacion($id));
	}	
}
