<?php

class historicoinscripcionesController extends crudController {

	public function __construct() {
		//funcion exporta .xls
		Crud::setExport(true);
		//funcion buscar
		Crud::setSearch(true);
		//titulo catalogo
		Crud::setTitulo('Histórico de inscripciones');

		//conexion db tabla
		Crud::setTabla('solicitudinscripcioncontingentes');
		Crud::setTablaId('solicitudinscripcioncontingenteid');

		//relacion entre tablas
		Crud::setLeftJoin('solicitudinscripciones AS si', 'solicitudinscripcioncontingentes.solicitudinscripcionid', '=', 'si.solicitudinscripcionid');
		Crud::setLeftJoin('contingentes AS c', 'solicitudinscripcioncontingentes.contingenteid', '=', 'c.contingenteid');
		Crud::setLeftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid');
		Crud::setLeftJoin('productos AS p', 'c.productoid', '=', 'p.productoid');

		//asigna valor de session y condiciona
		$tselected = Session::get('tselected');
		if($tselected <> 0) {
			Crud::setWhere('t.tratadoid', $tselected);
			Crud::setTitulo('Histórico de inscripciones - '.Tratado::getNombre($tselected));
		}

		//condiciona rol
		if(in_array(Auth::user()->rolid, Config::get('contingentes.rolempresa'))) {
			$nit = DB::table('empresas')->where('empresaid', Auth::user()->empresaid)->pluck('nit');
			Crud::setWhere('si.nit', $nit);
		}

		//definicion de campos para catalogo con datos del db
		Crud::setCampo(array('nombre'=>'Nombre','campo'=>'si.nombre'));
		Crud::setCampo(array('nombre'=>'Email','campo'=>'si.email'));
		Crud::setCampo(array('nombre'=>'Tratado','campo'=>'t.nombrecorto'));
		Crud::setCampo(array('nombre'=>'Producto','campo'=>'p.nombre'));
		Crud::setCampo(array('nombre'=>'Fecha de solicitud','campo'=>'si.created_at', 'tipo'=>'datetime','class'=>'text-right'));
		Crud::setCampo(array('nombre'=>'Observaciones','campo'=>'si.observaciones'));
		Crud::setCampo(array('nombre'=>'Estado','campo'=>'si.estado'));

		//boton extra
		Crud::setBotonExtra(array('url'=>'/historicosolicitudes/inscripcion/archivos/{id}','icon'=>'fa fa-file-o','titulo'=>'Archivos adjuntos','class'=>'primary', 'target'=>'_blank'));
		
		//permisos cancerbero
		Crud::setPermisos(array('add'=>false,'edit'=>false,'delete'=>false));
	}

	public function archivos($id) {
		//captura id
		$id = Crypt::decrypt($id);

		//retorna dots a la vista segun id
		return View::make('historico.archivosinscripcion')
			->with('titulo', 'Archivos adjuntos para solicitud de inscripción')
			->with('solicitud', Solicitudinscripcion::getSolicitud($id))
			->with('archivos', Solicitudinscripcionrequemiento::getArchivos($id));
	}	
}
