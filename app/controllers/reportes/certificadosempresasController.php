<?php

class certificadosempresasController extends BaseController {
  
  public function index() {
    return View::make('reportes/filtros')
			->with('titulo', 'Certificados por empresa')
			->with('contingentes', Contingente::getContingentesCuota())
			->with('tratados', Tratado::getTratados())
			->with('filters', ['tratados','contingentes','periodos','formato','fechaini','fechafin'])
			->with('todos',['empresas']);
  }

  public function store() {
		$periodoid     = Crypt::decrypt(Input::get('cmbPeriodo'));
		$tratadoid     = Crypt::decrypt(Input::get('tratadoid'));
		$contingenteid = Crypt::decrypt(Input::get('cmbContingente'));
		$fechaini      = Components::fechaHumanoAMySql(Input::get('fechaini')).' 00:00';
		$fechafin      = Components::fechaHumanoAMySql(Input::get('fechafin')).' 23:59';
		$formato       = Input::get('formato');

  	$certificados  = Movimiento::getCertificadosPorEmpresa($periodoid, $fechaini, $fechafin);
  	$tratado       = Tratado::getNombre($tratadoid);
  	$producto      = Contingente::getProducto($contingenteid);

  	if($formato == 'pdf') {
  		PDF::SetTitle('Certificados por Empresa');
      PDF::AddPage();
      PDF::setLeftMargin(20);

      $html = View::make('reportes.certificadosporempresapdf', [
				'titulo'       => 'Certificados por empresa',
				'certificados' => $certificados,
				'tratado'      => $tratado,
				'producto'     => $producto,
				'formato'      => $formato,
	  	]);

      PDF::writeHTML($html, true, false, true, false, '');
      PDF::Output('Consolidado-utilizacion-Contingente.pdf');
  	}

  	return View::make('reportes.certificadosporempresa', [
			'titulo'       => 'Certificados por empresa',
			'certificados' => $certificados,
			'tratado'      => $tratado,
			'producto'     => $producto,
			'formato'      => $formato,
  	]);
  }
}