<?php

class tratadosController extends crudController {
	
	public function __construct() {
		Crud::setExport(true); 
		Crud::setTitulo('Tratados & contingentes');
		Crud::setTablaId('tratadoid');
		Crud::setTabla('tratados');

		Crud::setLeftJoin('paises AS p', 'tratados.paisid', '=', 'p.paisid');

		Crud::setCampo(array('nombre'=>'Nombre Corto','campo'=>'nombrecorto'));
	 	Crud::setCampo(array('nombre'=>'Nombre','campo'=>'tratados.nombre'));
	 	Crud::setCampo(array('nombre'=>'Tipo','campo'=>'tipo', 'tipo'=>'enum', 'enumarray'=>array('Importación'=>'Importación', 'Exportación'=>'Exportación'))); //NO ALMACENA EL VALOR DEL ENUM
	 	Crud::setCampo(array('nombre'=>'Contingentes', 'campo'=>'(SELECT count(*) FROM contingentes AS c WHERE c.tratadoid = tratados.tratadoid)', 'class'=>'text-right', 'editable'=>false));
	 	Crud::setCampo(array('nombre'=>'Validez (meses)', 'campo'=>'mesesvalidez', 'class'=>'text-right', 'reglas'=>array('numeric', 'notEmpty'), 'reglasmensaje'=>'El valor debe ser numérico'));
	 	Crud::setCampo(array('nombre'=>'País procedencia','campo'=>'p.nombre','editable'=>false));
	 	Crud::setCampo(array('nombre'=>'País procedencia',
	 						 'campo'=>'tratados.paisid' ,
	 						 'tipo'=>'combobox', 
	 						 'query'=>'SELECT  nombre, paisid FROM paises ORDER BY nombre', 
	 						 'combokey'=>'paisid',
	 						 'show'=>false));
	 	Crud::setCampo(array('nombre'=>'Texto certificado','campo'=>'textocertificado', 'tipo'=>'textarea', 'show'=>false));
	 	Crud::setCampo(array('nombre'=>'Activo','campo'=>'activo', 'tipo'=>'bool'));

	 	Crud::setBotonExtra(array('url'=>'contingentes?tratado=','icon'=>'glyphicon glyphicon-certificate','titulo'=>'Asignar Contingentes'));
	 
	 	Crud::setPermisos(Cancerbero::tienePermisosCrud('tratados'));
	}
	
}