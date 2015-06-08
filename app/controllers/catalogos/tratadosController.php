<?php

class tratadosController extends crudController {
	
	public function __construct() {
		Crud::setExport(true); 
		Crud::setTitulo('Tratados & contingentes');
		Crud::setTablaId('tratadoid');
		Crud::setTabla('tratados');

		Crud::setLeftJoin('paises AS p', 'tratados.paisid', '=', 'p.paisid');

		$tselected = Session::get('tselected');
		if($tselected <> 0) {
			Crud::setWhere('tratadoid', $tselected);
			Crud::setTitulo('Tratados & contingentes - '.Tratado::getNombre($tselected));
		}

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

	 	Crud::setBotonExtra(array('url'=>'contingentes?tratado=','icon'=>'glyphicon glyphicon-certificate','titulo'=>'Asignar Contingentes'));
	 
	 	Crud::setPermisos(Cancerbero::tienePermisosCrud('tratados'));
	}

	public function create() {
		return $this->edit(Crypt::encrypt(0));
	}

	public function edit($id) {
		$id = Crypt::decrypt($id);

		if($id <> 0)
			$data = Tratado::find($id);

		else
			$data = null;

		return View::make('tratados.edit')
			->with('data', $data)
			->with('paises', Pais::getPaises());
	}
}