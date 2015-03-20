<?php

class graficasController extends BaseController {

	public function saldo($id) {
		$contingenteid = Crypt::decrypt($id);
		$contingente   = Contingente::find($contingenteid);
		$asignacion    = Tipotratado::getAsignacion($contingente->tipotratadoid);
		$empresas      = Empresacontingente::getEmpresasContingente($contingenteid);

		if($asignacion == 1) { //cuenta corriente
			$data  = array();
			foreach($empresas as $empresa) {
				$consumido = Movimiento::getMovimientos($contingenteid, $empresa->empresaid, 'Certificado');
				$asignado  = Movimiento::getMovimientos($contingenteid, $empresa->empresaid, 'Asignacion');

				$data[$empresa->empresaid]['nombre']    = $empresa->nombre;
				$data[$empresa->empresaid]['asignado']  = $asignado->cantidad; 
				$data[$empresa->empresaid]['consumido'] = $consumido->cantidad;
			}

			$view  = 'cc';
			$saldo = 0;
		}

		else { //PTPD
			$saldo = DB::select(DB::raw('SELECT getSaldo('.$contingenteid.', NULL) AS disponible'));
			$data  = array();
			foreach($empresas as $empresa) {
				$consumido = Movimiento::getMovimientos($contingenteid, $empresa->empresaid, 'Certificado');
				$data[$empresa->empresaid]['nombre']    = $empresa->nombre;
				$data[$empresa->empresaid]['consumido'] = $consumido->cantidad;
			}

			$view  = 'ptpd';
			$saldo = $saldo[0]->disponible;
		}

		return View::make('reportes.saldos.'.$view)
			->with('titulo', 'Consumo de contingente por empresa')
			->with('tratado', Tratado::getNombre($contingente->tratadoid))
			->with('producto', Producto::getNombre($contingente->productoid))
			->with('saldo', $saldo)
			->with('empresas', $data);
	}
}
