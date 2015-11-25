<?php

class cuentacorrienteController extends BaseController {
	
	public function index() {
		//retorna valores a la vista
		return View::make('reportes/filtros')
			->with('titulo', 'Cuenta Corriente - Contingentes')
			->with('tratados', Tratado::getTratados())
			->with('contingentes', Contingente::getContingentes())
			->with('filters', array('tratados','contingentes', 'periodos','formato'))
    	->with('todos', array());
	}

	public function store() {
		//obtiene del id del periodo
		$periodoId = Crypt::decrypt(Input::get('cmbPeriodo'));
		//consulta en db segun valor del parametro
		$periodo   = Periodo::getPeriodoInfo($periodoId);
		//obtener formato
		$formato   = Input::get('formato');

		//valida pdf
		if($formato == 'pdf') {
			PDF::SetTitle('Cuenta Corriente - Contingentes');
			PDF::AddPage();
			PDF::setLeftMargin(20);

			//retorna vista pdf
			$html = View::make('reportes/cuentacorrientepdf')
				->with('titulo', 'Cuenta Corriente - Contingentes')
				->with('tratado', $periodo->tratado)
				->with('producto', $periodo->producto)
				->with('movimientos', Movimiento::getCuentaCorriente($periodoId))
				->with('formato', 'html');

			PDF::writeHTML($html, true, false, true, false, '');
			PDF::Output('CC-Contingente.pdf');
		}

		else {
			//retorna datos a la vista
			return View::make('reportes/cuentacorriente')
				->with('titulo', 'Cuenta Corriente - Contingentes')
				->with('tratado', $periodo->tratado)
				->with('producto', $periodo->producto)
				->with('movimientos', Movimiento::getCuentaCorriente($periodoId))
				->with('formato', $formato);
		}
	}

	public function getPeriodos($aContingenteId) {
		$response = array('codigoerror'=>0, 'error'=>'', 'data' => '');

		//consulta en db segun parametro
		$periodos = Periodo::getPeriodosContingente(Crypt::decrypt($aContingenteId));

		//condiciona $periodos
		if ((count($periodos) <= 0) && !Input::has('todos')) {
			//asigna valores al areglo
			$response['codigoerror'] = 1;
			$response['error']       = 'No se tienen períodos activos para el contingente seleccionado';
		}

		//asigna como valor la vista de retorno
		else
			$response['data'] = View::make('partials/periodos')->with('periodos', $periodos)->render();
		
		//retorna datos en json
		return Response::json($response);
	}

	//convierte fecha a humano
	private function getFechaMySql($aFecha) {
		$arr = explode('/', $aFecha);
		return $arr[2].'-'.$arr[1].'-'.$arr[0];
	}
}