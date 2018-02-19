<?php

class periodospenalizacionesController extends BaseController {

	public function index() {
		//captura periodoid
		$periodoid = Input::get('periodo');
		//consulta en db segun $periodoid
		$periodo   = Periodo::getPeridoAsignacion(Crypt::decrypt($periodoid));
		//consulta en db segun $periodo
		$empresas  = Empresacontingente::getEmpresasContingente($periodo->contingenteid);

		//retorna mensaje si no existe
		if(count($empresas) <= 0) {
			Session::flash('message', 'No hay usuarios inscritos en este período');
			Session::flash('type', 'danger');

			return Redirect::to('periodos');
		}

		//retorna datos a la vista
		return View::make('penalizaciones/index')
			->with('periodo', $periodo)
			->with('periodoid', $periodoid)
			->with('empresas', $empresas);
	}

	public function store() {
		//obtiene ids de index
		$periodoid = Crypt::decrypt(Input::get('periodo'));
		$empresaid = Crypt::decrypt(Input::get('cmbEmpresa'));
		$tipoid    = Crypt::decrypt(Input::get('cmbTipo'));

		//consulta en db segun $empresa id
		$usuarioid = DB::table('authusuarios')->where('empresaid', $empresaid)->pluck('usuarioid');

		//ingresa datos db
		$movimiento                   = new Movimiento;
		$movimiento->tipomovimientoid = $tipoid;
		$movimiento->periodoid        = $periodoid;
		$movimiento->cantidad         = ($tipoid == 4? (Input::get('txCantidad') * -1), Input::get('txCantidad'));
		$movimiento->comentario       = ($tipoid == 4 ? 'Penalización: ' : 'Devolución: ').trim(Input::get('txComentario'));
		$movimiento->created_by       = Auth::id();
		$movimiento->usuarioid        = $usuarioid;
		$movimiento->save();

		//muestra mensaje
		Session::flash('message', 'Operación realizada exitosamente');
		Session::flash('type', 'success');

		//retorna la vista
		return Redirect::to('periodos');
	}
}
