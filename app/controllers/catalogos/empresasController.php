<?php

class empresasController extends BaseController {
	
	public function index() {
		//obtiene dato de session
		$tselected = Session::get('tselected');

		$id = 0;
		if(Input::has('contingente'))
			$id = Crypt::decrypt(Input::get('contingente'));

		//consulta en db segun parametros
		$empresas  = Tratado::getEmpresasTratado($tselected, $id);

		$data = array();
		foreach($empresas as $empresa) {
			//almacena los datos en un array
			$data[$empresa->tratado][$empresa->producto]['empresas'][] = array(
				'empresa'            => $empresa->empresa,
				'nit'                => $empresa->nit,
				'domiciliocomercial' => $empresa->domiciliocomercial,
				'telefono'           => $empresa->telefono,
				'fechainscripcion'   => $empresa->fechainscripcion
			);
		}
		//retorna datos a la vista
		return View::make('reportes.empresas')
			->with('datos', $data);
	}
}