<?php

class plantillaController extends BaseController {
	
	public function plantilla1() {

		return View::make('template.template1');
	}
}