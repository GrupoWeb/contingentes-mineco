<?php

class registroController extends BaseController {

	public function index() {
		return View::make('registro/template')
			->with('route', 'signup.store')
			->with('productos', Producto::where('activo', 1)->get());
	}
}