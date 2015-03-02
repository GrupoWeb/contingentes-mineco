<?php

class graficasController extends BaseController {

	public function saldo($id) {
		$contingenteid = Crypt::decrypt($id);
		$empresas      = Usuariocontingente::getUsuariosContingente($contingenteid);

		$data = array();
		foreach($empresas as $empresa) {
			$data[$empresa->usuarioid]['nombre'] = $empresa->nombre;
		}

		dd($data);
		return View::make('reportes.saldotratados');
	}
}
