<?php

class graficasController extends BaseController {

	public function saldo($id) {
		$contingenteid = Crypt::decrypt($id);
		$contingente   = Contingente::find($contingenteid);
		$empresas      = Usuariocontingente::getUsuariosContingente($contingenteid);
		$saldo         = DB::select(DB::raw('SELECT getSaldo('.$contingenteid.', NULL) AS disponible'));

		$data = array();
		foreach($empresas as $empresa) {
			$consumido = Movimiento::getConsumidoPTPD($contingenteid, $empresa->usuarioid);
			$data[$empresa->usuarioid]['nombre']    = $empresa->nombre;
			$data[$empresa->usuarioid]['consumido'] = $consumido->cantidad;
		}

		//dd($data);
		return View::make('reportes.saldos.ptpd')
			->with('titulo', 'Consumo de contingente por empresa')
			->with('tratado', Tratado::getNombre($contingente->tratadoid))
			->with('producto', Producto::getNombre($contingente->productoid))
			->with('saldo', $saldo[0]->disponible)
			->with('empresas', $data);
	}
}
