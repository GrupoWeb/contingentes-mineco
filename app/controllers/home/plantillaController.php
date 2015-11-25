<?php

class plantillaController extends BaseController {
	
	public function plantilla1() {
		return View::make('template.template1');
	}
	public function plantilla2() {
		return View::make('template.template2');
	}
	public function plantilla3() {
		return View::make('template.template3');
	}
}