<?php
class emisionController extends BaseController {
	function index(){
		return View::make('emision.index')
			->with('productos', Producto::where('activo', 1)->get());
	}
}