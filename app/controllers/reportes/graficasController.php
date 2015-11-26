<?php

class graficasController extends BaseController {

	/*--- tabla tipomovimientoids de movimiento 
	| 1 - cuota
	| 2 - certificado
	| 3 - asignacion
	| 4 - penalizacion	
	*/

	public function saldo($id) {
		//captura id de contingente
		$contingenteid = Crypt::decrypt($id);
		//consulta en db segun id
		$contingente   = Contingente::find($contingenteid);
		//consulta en db segun parametro
		$asignacion    = Tipotratado::getAsignacion($contingente->tipotratadoid);
		//consulta en db segun id
		$empresas      = Empresacontingente::getEmpresasContingente($contingenteid);

		if($asignacion == 1) { //cuenta corriente
			$data  = array();
			//pasa valores del objeto al areglo
			foreach($empresas as $empresa) {
				//consulta en db segun parametros
				$datos = Movimiento::getConsumoYSaldo($empresa->empresaid, $contingenteid);
			
				$data[$empresa->empresaid]['nombre']     = $empresa->nombre;
				$data[$empresa->empresaid]['consumido']  = $datos->total - $datos->saldo; 
				$data[$empresa->empresaid]['saldo']      = $datos->saldo;
			}

			$view  = 'cc';
			$saldo = 0;
		}

		else { //PTPD
			$saldo = DB::select(DB::raw('SELECT getSaldo('.$contingenteid.', NULL) AS disponible'));
			$data  = array();
			//asigna valores del objeto al areglo
			foreach($empresas as $empresa) {
				$consumido = Movimiento::getMovimientos($contingenteid, $empresa->empresaid, 2);
				$data[$empresa->empresaid]['nombre']    = $empresa->nombre;
				$data[$empresa->empresaid]['consumido'] = $consumido->cantidad;
			}

			$view  = 'ptpd';
			$saldo = $saldo[0]->disponible;
		}

		//retona los datos ala vista
		return View::make('reportes.saldos.'.$view)
			->with('formato','html')
			->with('titulo', 'Consumo de contingente por empresa')
			->with('tratado', Tratado::getNombre($contingente->tratadoid))
			->with('producto', Producto::getNombre($contingente->productoid))
			->with('saldo', $saldo)
			->with('empresas', $data);
	}
}
