<?php
class emisionController extends BaseController {
	
	function index() {
		return View::make('emision.index')
			->with('contingentes', Usuariocontingente::getContingentes());
	}

	function store() {
		//dd(Input::all());

		$query      = DB::select(DB::raw('SELECT getSaldo('.Input::get('contingentes').','.Auth::id().') AS disponible'));
		$disponible = $query[0]->disponible;

		dd($disponible);
	}
}