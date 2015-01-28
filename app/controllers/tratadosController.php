<?php

class tratadosController extends crudController {
	
	public function __construct() {
		Crud::setExport(true); 
		Crud::setTitulo('Tratados & contingentes');
		Crud::setTablaId('tratadoid');
		Crud::setTabla('tratados');

		$tselected = Session::get('tselected');
		if($tselected <> 0) {
			Crud::setWhere('tratadoid', $tselected);
			Crud::setTitulo('Tratados & contingentes - '.Tratado::getNombre($tselected));
		}

		Crud::setCampo(array('nombre'=>'Nombre Corto','campo'=>'nombrecorto'));
	 	Crud::setCampo(array('nombre'=>'Nombre','campo'=>'nombre'));
	 	Crud::setCampo(array('nombre'=>'Tipo','campo'=>'tipo', 'tipo'=>'enum', 'enumarray'=>array('Importación'=>'Importación', 'Exportación'=>'Exportación'))); //NO ALMACENA EL VALOR DEL ENUM
	 	Crud::setCampo(array('nombre'=>'Contingentes', 'campo'=>'(SELECT count(*) FROM contingentes AS c WHERE c.tratadoid = tratados.tratadoid)', 'class'=>'text-right', 'editable'=>false));
	 	Crud::setCampo(array('nombre'=>'Validez (meses)', 'campo'=>'mesesvalidez', 'class'=>'text-right', 'reglas'=>array('numeric', 'notEmpty'), 'reglasmensaje'=>'El valor debe ser numérico'));
	 	Crud::setCampo(array('nombre'=>'País procedencia','campo'=>'paisprocedencia'));
	 	Crud::setCampo(array('nombre'=>'Texto certificado','campo'=>'textocertificado', 'tipo'=>'textarea', 'show'=>false));
	 	Crud::setCampo(array('nombre'=>'Activo','campo'=>'activo', 'tipo'=>'bool'));

	 	Crud::setBotonExtra(array('url'=>'contingentes?tratado=','icon'=>'glyphicon glyphicon-certificate','titulo'=>'Asignar Contingentes'));
	 
	 	Crud::setPermisos(Cancerbero::tienePermisosCrud('tratados'));
	}
	
}