<?php

class historicoactualizacionesController extends crudController {

	public function __construct() {
		//funcion de exportar xls
		Crud::setExport(true);
		//funcion de buscar
		Crud::setSearch(true);
		//tirulo catalogo
		Crud::setTitulo('Histórico de actualizaciones');

		//conexion db a la tabla
		Crud::setTabla('solicitudactualizacion');
		Crud::setTablaId('actualizacionid');

		//relacion entre tablas
		Crud::setLeftJoin('authusuarios AS u', 'solicitudactualizacion.usuarioid', '=', 'u.usuarioid');
		Crud::setLeftJoin('empresas AS e', 'solicitudactualizacion.empresaid', '=', 'e.empresaid');

		//condiciona where
		if(in_array(Auth::user()->rolid, Config::get('contingentes.rolempresa'))) {
			Crud::setWhere('empresaid', Auth::user()->empresaid);
		}

		//define campos con datos de la db
		Crud::setCampo(array('nombre'=>'Nombre','campo'=>'u.nombre'));
		Crud::setCampo(array('nombre'=>'Empresa','campo'=>'e.razonsocial'));
		Crud::setCampo(array('nombre'=>'NIT','campo'=>'e.nit'));
		Crud::setCampo(array('nombre'=>'Fecha','campo'=>'solicitudactualizacion.created_at','tipo'=>'datetime'));
		Crud::setCampo(array('nombre'=>'Observaciones','campo'=>'observaciones'));
		Crud::setCampo(array('nombre'=>'Estado','campo'=>'estado'));

		//bonton extra 
		Crud::setBotonExtra(array('url'=>'/historicosolicitudes/actualizacion/archivos/{id}','icon'=>'fa fa-file-o','titulo'=>'Archivos adjuntos','class'=>'primary', 'target'=>'_blank'));
		//permiso de cancerbero
		Crud::setPermisos(array('add'=>false,'edit'=>false,'delete'=>false));
	}

	public function archivos($id) {
		//captura id
		$id = Crypt::decrypt($id);
		
		//retorna datos a la vista segun id
		return View::make('historico.archivosactualizacion')
			->with('titulo', 'Archivos adjuntos para solicitud de actualizacion')
			->with('solicitud', Solictudactualizacion::getSolicitud($id))
			->with('archivos', Solictudactualizacionarchivo::getArchivosActualizacion($id));
	}	
}
