<?php
class dashboardController extends BaseController {
	public function index() {
		$admin = in_array(Auth::user()->rolid, Config::get('contingentes.roladmin'));
		
		return View::make('dashboard.index')
			->with('admin', $admin);
	}
}