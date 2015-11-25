<?php

class tratadosController extends crudController {
	
	public function __construct() {
		//funsion exportar .xls
		Crud::setExport(true); 
		//titulo catalogo
		Crud::setTitulo('Tratados & contingentes');
		//conexion db
		Crud::setTablaId('tratadoid');
		Crud::setTabla('tratados');

		//relacion entre tablas
		Crud::setLeftJoin('paises AS p', 'tratados.paisid', '=', 'p.paisid');

		//obtiene dato de session
		$tselected = Session::get('tselected');
		if($tselected <> 0) {
			Crud::setWhere('tratadoid', $tselected);
			Crud::setTitulo('Tratados & contingentes - '.Tratado::getNombre($tselected));
		}

		//definicion de campos con datos de la conexion db
		Crud::setCampo(array('nombre'=>'Nombre Corto','campo'=>'nombrecorto'));
	 	Crud::setCampo(array('nombre'=>'Nombre','campo'=>'tratados.nombre'));
	 	Crud::setCampo(array('nombre'=>'Tipo','campo'=>'tipo', 'tipo'=>'enum', 'enumarray'=>array('Importación'=>'Importación', 'Exportación'=>'Exportación'))); //NO ALMACENA EL VALOR DEL ENUM
	 	Crud::setCampo(array('nombre'=>'Contingentes', 'campo'=>'(SELECT count(*) FROM contingentes AS c WHERE c.tratadoid = tratados.tratadoid)', 'class'=>'text-right', 'editable'=>false));
	 	Crud::setCampo(array('nombre'=>'Validez (meses)', 'campo'=>'mesesvalidez', 'class'=>'text-right', 'reglas'=>array('numeric', 'notEmpty'), 'reglasmensaje'=>'El valor debe ser numérico'));
	 	Crud::setCampo(array('nombre'=>'País','campo'=>'p.nombre','editable'=>false));
	 	Crud::setCampo(array('nombre'=>'País',
	 						 'campo'=>'tratados.paisid' ,
	 						 'tipo'=>'combobox', 
	 						 'query'=>'SELECT  nombre, paisid FROM paises ORDER BY nombre', 
	 						 'combokey'=>'paisid',
	 						 'show'=>false));
	 	Crud::setCampo(array('nombre'=>'Activo','campo'=>'activo', 'tipo'=>'bool'));
	 	Crud::setCampo(array('nombre'=>'Color','campo'=>'clase','tipo'=>'enum','enumarray'=>array('sucess','warning','danger','primary','info','default'),'show'=>false));
	 	Crud::setCampo(array('nombre'=>'Icono','campo'=>'icono','tipo'=>'enum','enumarray'=>array('sucess','warning','danger','primary','info','default'),'show'=>false));

		Crud::setCampo(array('nombre'=>'Normativo', 'campo'=>'tratados.normativo', 'tipo'=>'file','filepath'=>'/normativos/', 'class'=>'text-center'));	

		//define boton extra
	 	Crud::setBotonExtra(array('url'=>'contingentes?tratado=','icon'=>'glyphicon glyphicon-certificate','titulo'=>'Asignar Contingentes'));
	 
	 	//permiso cancerbero
	 	Crud::setPermisos(Cancerbero::tienePermisosCrud('tratados'));
	}

	public function create() {
		//manda un valor al edit
		return $this->edit(Crypt::encrypt(0));
	}

	public function edit($id) {
		//obtiene id
		$id = Crypt::decrypt($id);

		//verifica valor id
		if($id <> 0)
			$data = Tratado::find($id);

		else
			$data = null;

		//retorna datos en vista
		return View::make('tratados.edit')
			->with('data', $data)
			->with('paises', Pais::getPaises());
	}
}