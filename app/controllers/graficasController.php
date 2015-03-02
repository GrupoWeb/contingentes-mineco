<?php

class graficasController extends BaseController {

	public function saldo($id) {
		//$tratadoid     = Session::get('tselected');
		$contingenteid = Crypt::decrypt($id);
		$empresas      = Usuariocontingente::getUsuariosContingente($contingenteid);
		//$empresas  = Tratado::getUsuariosTratado($tselected);

		dd($empresas);
		return View::make('reportes.saldotratados');
	}
}
