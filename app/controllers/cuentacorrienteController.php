<?php

class cuentacorrienteController extends BaseController {
	
	public function index() {
		$contingente = Contingente::find(1);
		$producto    = Producto::find($contingente->productoid);
		$tratado     = Tratado::find($contingente->tratadoid);

		return View::make('reportes/cuentacorriente')
			->with('titulo', 'Cuenta Corriente')
			->with('tratado', $tratado->nombrecorto)
			->with('producto', $producto->nombre)
			->with('movimientos', Movimiento::getCuentaCorriente(69, '2015-01-01 00:00', '2015-01-20 00:00'));
	}
}