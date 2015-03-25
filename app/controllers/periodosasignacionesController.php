<?php

class periodosasignacionesController extends BaseController {
	
	public function index() {
		$periodoid = Input::get('periodo');
		$periodo   = Periodo::getPeridoAsignacion(Crypt::decrypt($periodoid));

		$usuarios = array();
		if($periodo->tipotratadoid == 2)
			$usuarios = DB::table('authusuarios')->where('rolid', 3)->where('activo', 1)->get();

		return View::make('asignaciones/periodos')
			->with('periodo', $periodo)
			->with('periodoid', $periodoid)
			->with('usuarios', $usuarios);
	}

	public function store() {
		$periodoid = Crypt::decrypt(Input::get('periodo'));

		$movimiento                   = new Movimiento;
		$movimiento->tipomovimientoid = DB::table('tiposmovimiento')->where('nombre', 'Cuota')->pluck('tipomovimientoid');
		$movimiento->periodoid        = $periodoid;
		$movimiento->cantidad         = Input::get('txCantidad');
		$movimiento->comentario       = Input::get('txComentario');
		$movimiento->created_by       = Auth::id();

		if(Input::has('cmbUsuario'))
			$movimiento->usuarioid = Input::get('cmbUsuario');
		
		$movimiento->save();

		Session::flash('message', 'Asignación realizada exitosamente');
		Session::flash('type', 'success');

		return Redirect::to('periodos');
	}
}