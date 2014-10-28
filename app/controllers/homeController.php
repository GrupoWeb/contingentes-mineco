<?php
/** PARTE DEL CORE! NO MODIFICAR **/
class homeController extends BaseController {
	public function index() {
    //dd(Session::all());
    $solicitudes = Solicitudpendiente::getSolicitudesPendientes();
		return View::make('home/index')
			->with('usuario', Auth::user())->with('solicitudes', $solicitudes);
	}

	public function about() {
		return View::make('home/about');
	}
}