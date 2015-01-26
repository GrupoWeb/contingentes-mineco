<?php

class dashboardController extends BaseController {
	public function index() {
		$admin = in_array(Auth::user()->rolid, Config::get('contingentes.roladmin'));
 

		if($admin){
			return View::make('dashboard.admin')
				->with('inscripcion', count(Inscripcionpendiente::getSolicitudesPendientes()))
				->with('asignacion', Solicitudasignacion::where('estado', 'Pendiente')->count())
				->with('emision', Solicitudesemision::where('estado', 'Pendiente')->count());
		}
		
		return View::make('dashboard.index')
			->with('admin', $admin);
	}
}