<?php
/** PARTE DEL CORE! NO MODIFICAR **/
class homeController extends BaseController {
	public function index() {
    //dd(Session::all());
		return View::make('home/index')
			->with('usuario', Auth::user());
	}

	public function about() {
		return View::make('home/about');
	}
}