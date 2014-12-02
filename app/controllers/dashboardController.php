<?php
class dashboardController extends BaseController {
	public function index() {
		$admin = in_array(Auth::user()->rolid, Config::get('contingentes.roladmin'));

		if($admin){
			$inscripciones = Inscripcionpendiente::getSolicitudesPendientes();

			return View::make('dashboard.admin')
				->with('inscripcion', count($inscripciones))
				->with('asignacion', 2)
				->with('emision', 0);
		}
		
		return View::make('dashboard.index')
			->with('admin', $admin);
	}
}