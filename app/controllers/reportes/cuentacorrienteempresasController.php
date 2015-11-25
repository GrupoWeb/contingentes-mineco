<?php

class cuentacorrienteempresasController extends BaseController {
	
	public function index() {
		//retorna valores a la vista
		return View::make('reportes/filtros')
			->with('titulo', 'Cuenta Corriente - Empresas')
			->with('contingentes', Contingente::getContingentesCuota())
			->with('tratados', Tratado::getTratados())
			->with('filters', ['tratados','contingentes', 'periodos','empresas','formato'])
			->with('todos',['empresas']);
	}

	public function store() {
		//asigna valores del formulario
		$empresaId = Crypt::decrypt(Input::get('cmbEmpresa'));
		$periodoId = Crypt::decrypt(Input::get('cmbPeriodo'));
		$periodo   = Periodo::getPeriodoInfo($periodoId);
		$formato   = Input::get('formato');

		//quema valor a $empresaid
		if ($empresaId==-1) $empresaId = 0;

		//valida pdf
		if($formato == 'pdf') {
			PDF::SetTitle('Cuenta Corriente - Empresas');
			PDF::AddPage();
			PDF::setLeftMargin(20);

			$html = View::make('reportes/cuentacorrienteempresaspdf')
				->with('titulo', 'Cuenta Corriente - Empresas')
				->with('tratado', $periodo->tratado)
				->with('producto', $periodo->producto)
				->with('asignacion', $periodo->asignacion)
				->with('movimientos', Movimiento::getCuentaCorrienteEmpresa($periodoId, $empresaId))
				->with('formato', 'html');

			PDF::writeHTML($html, true, false, true, false, '');
			PDF::Output('CC-Empresas.pdf');
		}

		else {
			//consulta en db segun parametros
			$movimientos = Movimiento::getCuentaCorrienteEmpresa($periodoId, $empresaId);
			$tmp         = [];

			//asigna valores del objeto a un areglo
			foreach($movimientos as $movimiento) {
				$tmp[$movimiento->acreditadoa][] = [
					'fecha'         => $movimiento->fecha,
					'acreditadopor' => $movimiento->acreditadopor,
					'comentario'    => $movimiento->comentario,
					'certificado'   => $movimiento->certificadoid,
					'credito'       => $movimiento->credito,
					'debito'        => $movimiento->debito,
				];
			}

			//retona datos a la vista
			return View::make('reportes.cuentacorrienteempresas')
				->with('titulo', 'Cuenta Corriente - Empresas')
				->with('tratado', $periodo->tratado)
				->with('producto', $periodo->producto)
				->with('asignacion', $periodo->asignacion)
				->with('movimientos', $tmp)
				->with('formato', $formato);
		}
	}

	public function getEmpresas($aContingenteId) {
		//retorna valores a la vista segun $aContingenteId
		return View::make('partials/empresas')
			->with('empresas', Empresacontingente::getEmpresasContingente(Crypt::decrypt($aContingenteId)));
	}
}