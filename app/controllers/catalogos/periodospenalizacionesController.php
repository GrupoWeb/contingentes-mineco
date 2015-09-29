<?php

class periodospenalizacionesController extends BaseController {

	public function index() {
		$periodoid = Input::get('periodo');
		$periodo   = Periodo::getPeridoAsignacion(Crypt::decrypt($periodoid));
		$empresas  = Empresacontingente::getEmpresasContingente($periodo->contingenteid);

		if(count($empresas) <= 0) {
			Session::flash('message', 'No hay usuarios inscritos en este período');
			Session::flash('type', 'danger');

			return Redirect::to('periodos');
		}

		return View::make('penalizaciones/index')
			->with('periodo', $periodo)
			->with('periodoid', $periodoid)
			->with('empresas', $empresas);
	}

	public function store() {
		$periodoid = Crypt::decrypt(Input::get('periodo'));
		$empresaid = Crypt::decrypt(Input::get('cmbEmpresa'));
		$tipoid    = Crypt::decrypt(Input::get('cmbTipo'));
		$usuarioid = DB::table('authusuarios')->where('empresaid', $empresaid)->pluck('usuarioid');

		$movimiento                   = new Movimiento;
		$movimiento->tipomovimientoid = $tipoid;
		$movimiento->periodoid        = $periodoid;
		$movimiento->cantidad         = (Input::get('txCantidad') * -1);
		$movimiento->comentario       = ($tipoid == 4 ? 'Penalización: ' : 'Devolución: ').trim(Input::get('txComentario'));
		$movimiento->created_by       = Auth::id();
		$movimiento->usuarioid        = $usuarioid;
		$movimiento->save();

		Session::flash('message', 'Operación realizada exitosamente');
		Session::flash('type', 'success');

		return Redirect::to('periodos');
	}
}
