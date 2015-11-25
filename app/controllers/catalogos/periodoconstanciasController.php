<?php

class periodoconstanciasController extends crudController {

	public function __construct() {
		//captura periodoid
		$periodoid = Crypt::decrypt(Input::get('periodo'));
		//consula en db segun periodoid
		$periodo   = Periodo::getNombrePeriodo($periodoid);

		//funsion exportar .xls
		Crud::setExport(false);
		//titulo catalogo
		Crud::setTitulo('Constancias '.$periodo->nombrecorto.' - '.$periodo->nombre);
		//conexion db
		Crud::setTabla('constancias');
		Crud::setTablaId('constanciaid');

		//relacion de tablas db
		Crud::setLeftJoin('movimientos AS m', 'constancias.movimientoid', '=', 'm.movimientoid'); 
		//condicion
		Crud::setWhere('m.periodoid', $periodoid);
		//definicion de campos con datos de db
		Crud::setCampo(array('nombre'=>'Fecha','campo'=>'constancias.created_at', 'tipo'=>'datetime'));
		Crud::setCampo(array('nombre'=>'Constancia','campo'=>'constancias.archivo', 'tipo'=>'file', 'filepath'=>'/archivos/constancias/'));
		Crud::setCampo(array('nombre'=>'Cantidad','campo'=>'m.cantidad', 'tipo'=>'numeric', 'decimales'=>3, 'class'=>'text-right'));
		Crud::setCampo(array('nombre'=>'Comentario','campo'=>'m.comentario'));

		//permisos cancerbero
		Crud::setPermisos(Cancerbero::tienePermisosCrud('periodoconstancias'));
	}
}