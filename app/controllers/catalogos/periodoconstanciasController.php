<?php

class periodoconstanciasController extends crudController {

	public function __construct() {
		$periodoid = Crypt::decrypt(Input::get('periodo'));
		$periodo   = Periodo::getNombrePeriodo($periodoid);

		Crud::setExport(false);
		Crud::setTitulo('Constancias '.$periodo->nombrecorto.' - '.$periodo->nombre);
		Crud::setTabla('constancias');
		Crud::setTablaId('constanciaid');

		Crud::setLeftJoin('movimientos AS m', 'constancias.movimientoid', '=', 'm.movimientoid'); 

		Crud::setWhere('m.periodoid', $periodoid);

		Crud::setCampo(array('nombre'=>'Fecha','campo'=>'constancias.created_at', 'tipo'=>'datetime'));
		Crud::setCampo(array('nombre'=>'Constancia','campo'=>'constancias.archivo', 'tipo'=>'file', 'filepath'=>'/archivos/constancias/'));
		Crud::setCampo(array('nombre'=>'Cantidad','campo'=>'m.cantidad', 'tipo'=>'numeric', 'decimales'=>3, 'class'=>'text-right'));
		Crud::setCampo(array('nombre'=>'Comentario','campo'=>'m.comentario'));

		Crud::setPermisos(Cancerbero::tienePermisosCrud('periodoconstancias'));
	}
}