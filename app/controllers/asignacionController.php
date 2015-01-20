<?php

class asignacionController extends BaseController {

	public function index() {
		return View::make('asignaciones/index')
			->with('contingentes', Usuariocontingente::getContingentes());
	}
}