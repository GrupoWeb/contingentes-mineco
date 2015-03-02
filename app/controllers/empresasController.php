<?php

class empresasController extends BaseController {
	
	public function index() {
		$tselected = Session::get('tselected');

		$id = 0;
		if(Input::has('contingente'))
			$id = Crypt::decrypt(Input::get('contingente'));

		$empresas  = Tratado::getUsuariosTratado($tselected, $id);

		$data = array();
		foreach($empresas as $empresa) {
			$data[$empresa->tratado][$empresa->producto]['empresas'][] = array(
				'empresa'            => $empresa->empresa,
				'email'              => $empresa->email,
				'nit'                => $empresa->nit,
				'domiciliocomercial' => $empresa->domiciliocomercial,
				'telefono'           => $empresa->telefono,
				'fechainscripcion'   => $empresa->fechainscripcion
			);
		}

		return View::make('reportes.empresas')
			->with('datos', $data);
	}
}