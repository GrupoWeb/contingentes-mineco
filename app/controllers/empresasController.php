<?php

class empresasController extends BaseController {
	
	public function index() {
		return View::make('reportes/filtros')
			->with('titulo', 'Empresas Inscritas')
			->with('contingentes', Contingente::getContingentes())
			->with('filters', array('fechaini', 'fechafin', 'contingentes'));
	}

	public function store() {
		$contingenteid = Crypt::decrypt(Input::get('cmbContingente'));
		
		$fechaini      = $this->getFechaMySql(Input::get('fechaini')).' 00:00';
		$fechafin      = $this->getFechaMySql(Input::get('fechafin')).' 23:59';
        
        
		$contingente = Contingente::find($contingenteid);
		$producto    = Producto::find($contingente->productoid);
		$tratado     = Tratado::find($contingente->tratadoid);
        $datos = Empresa::getEmpresas($contingenteid,$fechaini, $fechafin);
      
		return View::make('reportes/empresas')
			->with('titulo', 'Empresas Inscritas')
			->with('tratado', $tratado->nombrecorto)
			->with('producto', $producto->nombre)
			->with('datos', $datos);
	}
  
    private function getFechaMySql($aFecha) {
      $arr = explode('/', $aFecha);
      return $arr[2].'-'.$arr[1].'-'.$arr[0];

    }
}