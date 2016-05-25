<?php

class contingentesController extends crudController {
	
	public function __construct() {
		$response = array('codigoerror'=>0, 'error'=>'');
		
		//captura id
		try {
			$id = Crypt::decrypt(Input::get('tratado'));
		} catch (Exception $e) {
			//define error
			$id                      = -1;
			$response['codigoerror'] = 1;
			$response['error']       = 'Tratado invalido';
		}

		//funcion de exportar .xls
		Crud::setExport(true); 
		//titulo catalogo
		Crud::setTitulo(Tratado::getNombre($id).' - Contingentes');
		//conexion db
		Crud::setTablaId('contingenteid');
		Crud::setTabla('contingentes');

		//relacion de tablas db
		Crud::setLeftJoin('productos AS p', 'contingentes.productoid', '=', 'p.productoid');
		Crud::setLeftJoin('tipotratados AS t', 'contingentes.tipotratadoid', '=', 't.tipotratadoid');
		Crud::setLeftJoin('unidadesmedida AS u', 'contingentes.unidadmedidaid', '=', 'u.unidadmedidaid');
		Crud::setLeftJoin('plantillascertificados AS pc', 'contingentes.plantillaid', '=', 'pc.plantillaid');
		Crud::setLeftJoin('authusuarios AS r','contingentes.responsableid','=','r.usuarioid');
		Crud::setWhere('tratadoid', $id);
	
		//definicion de campos con la con la conexion y realaciones de tablas
		Crud::setCampo(array('nombre'=>'Producto','campo'=>'p.nombre', 'editable'=>false));
		Crud::setCampo(array('nombre'=>'Tipo','campo'=>'t.nombre', 'editable'=>false));
		Crud::setCampo(array('nombre'=>'Unidad de medida','campo'=>'u.nombrecorto', 'editable'=>false));
		Crud::setCampo(array('nombre'=>'Plantilla','campo'=>'pc.nombre', 'editable'=>false));
		Crud::setCampo(array('nombre'=>'Producto', 'campo'=>'p.productoid', 'tipo'=>'combobox', 'query'=>'SELECT nombre, productoid FROM productos ORDER BY nombre', 'combokey'=>'productoid', 'editable'=>true, 'show'=>false));
		Crud::setCampo(array('nombre'=>'Unidad de medida', 'campo'=>'unidadmedidaid', 'tipo'=>'combobox', 'query'=>'SELECT CONCAT(nombre," (",nombrecorto,")") AS nombre, unidadmedidaid FROM unidadesmedida ORDER BY nombre', 'combokey'=>'unidadmedidaid', 'editable'=>true, 'show'=>false));
	 	Crud::setCampo(array('nombre'=>'Tipo tratado', 'campo'=>'tipotratadoid', 'tipo'=>'combobox', 'query'=>'SELECT nombre, tipotratadoid FROM tipotratados', 'combokey'=>'tipotratadoid', 'editable'=>true, 'show'=>false));
	 	Crud::setCampo(array('nombre'=>'Variación (%)', 'campo'=>'variacion', 'class'=>'text-right', 'reglas'=>array('numeric', 'notEmpty'), 'reglasmensaje'=>'El valor debe ser numérico'));
	 	Crud::setCampo(array('nombre'=>'Plantilla certificado', 'campo'=>'plantillaid', 'tipo'=>'combobox', 'query'=>'SELECT nombre, plantillaid FROM plantillascertificados', 'combokey'=>'plantillaid', 'editable'=>true, 'show'=>false));
	 	Crud::setCampo(array('nombre'=>'Requiere Asignación', 'campo'=>'t.asignacion', 'tipo'=>'bool','editable'=>false));	
	 	Crud::setCampo(array('nombre'=>'Texto certificado','campo'=>'textocertificado', 'tipo'=>'textarea', 'show'=>false, 'reglas'=>array('notEmpty'),'reglasmensaje'=>'El texto es requerido'));
	
		Crud::setCampo(array('nombre'=>'Normativo', 'campo'=>'contingentes.normativo', 'tipo'=>'file','filepath'=>'/normativos/', 'class'=>'text-center'));	
		Crud::setCampo(array('nombre'=>'Responsable', 'campo'=>'r.nombre', 'editable'=>false));
		Crud::setCampo(array('nombre'=>'Responsable', 'campo'=>'responsableid', 'tipo'=>'combobox', 'query'=>'SELECT nombre, usuarioid FROM authusuarios WHERE rolid IN (' . implode(',', Config::get('contingentes.roldace')) . ') ORDER BY nombre', 'combokey'=>'responsableid', 'editable'=>true, 'show'=>false));
	 	Crud::setBotonExtra(array('url'=>'contingente/requerimientos/{id}?tratado='.Input::get('tratado'),'icon'=>'glyphicon glyphicon-list-alt','titulo'=>'Requerimientos'));
	 	Crud::setBotonExtra(array('url'=>'partidasarancelarias?contingente={id}','icon'=>'glyphicon glyphicon-th','titulo'=>'Fracciones arancelarias', 'class'=>'success'));

	 	//mantiene id en vista
	 	Crud::setHidden(array('campo'=>'tratadoid', 'valor'=>$id));
	 	
	 	//permisos cancerbero
	 	Crud::setPermisos(Cancerbero::tienePermisosCrud('contingentes'));
	}

	//obtener saldo
	public function getSaldo($contingenteid) {
		//variable para id
		try {
			$cid = Crypt::decrypt($contingenteid);
		} catch (Exception $e) {
			$response['codigoerror'] = 1;
			$response['error']       = 'Contingente inválido';
			return Response::json($response);
		}
		
		if (Auth::user()) {
			$empresaid = Auth::user()->empresaid;
		}
		else {
			$response['codigoerror'] = 2;
			$response['error']       = 'Usuario no encontrado';
			return Response::json($response);
		}

		//consulta db segun $cid
		$disponible             = DB::select(DB::raw('SELECT getSaldo('.$cid.','.Auth::user()->empresaid.') AS disponible'));
		if (!$disponible) {
			$response['codigoerror'] = 3;
			$response['error']       = 'Error obtieniendo saldo';
			return Response::json($response);
		}
		//declara valor de variable al arreglo
		$response['disponible'] = $disponible[0]->disponible;
		$response['unidad']     = Contingente::getUnidadMedida($cid);
		return Response::json($response);
	}


	public function getSaldoAsignacion($contingenteid) {
		//define un areglo a la variable
		$response = array('codigoerror'=>0, 'error'=>'');
		
		try {
			//captura id
			$cid       = Crypt::decrypt($contingenteid);
			$periodoid = Periodo::getPeriodo($cid);

			//consulta db segun $cid
			$disponible = DB::select(DB::raw('SELECT getSaldoAsignacionPeriodo('.$periodoid.') AS disponible'));
			//asigna valor a la variable
			$response['disponible'] = $disponible[0]->disponible;
			$response['unidad']     = Contingente::getUnidadMedida($cid);
		} catch(\Exception $e) {
			//muestra error
			$response['codigoerror'] = 2;
			$response['error']       = 'Error al calcular saldo del contingente. Posible contingente invalido';
		}
		//ingresa datos en json
		return Response::json($response);
	}
}