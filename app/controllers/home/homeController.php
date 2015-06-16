<?php

class homeController extends BaseController {
	
	public function index() {
		if (Auth::check()) {
			return Redirect::to('inicio');
		}
		else {
			return View::make('home/index');
		}
	}

	public function acuerdoscomerciales() {
		return View::make('home/acuerdoscomerciales')
			->with('contingentes', Contingente::getContingentes());
	}

	public function manuales() {
		return View::make('home/manuales');
	}
}