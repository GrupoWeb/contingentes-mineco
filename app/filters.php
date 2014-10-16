<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


Route::filter('rolvalidation', function()
{
	if (Auth::guest()) return Redirect::guest('login');
	
	//get modulo y permiso
	$arr     = explode('/', Request::path());
	$modulo  = 'index';
	$permiso = 'index';

	if(count($arr) >= 2){
		$modulo  = ($arr[0] == '') ? 'index':$arr[0];

		if(count($arr) >= 3)
			if(is_numeric($arr[1]))
				$permiso = ($arr[2] == '') ? 'index':$arr[2];
			else
				$permiso = ($arr[1] == '') ? 'index':$arr[1];
		else
			$permiso = ($arr[1] == '') ? 'index':$arr[1];

		if(count($arr) == 2)
			if(is_numeric($arr[1]))
				$permiso = 'index';
	}

	elseif(count($arr) == 1){
		$modulo  = $arr[0];
	}

	$moduloid  = DB::table('authmodulos')->where('nombre', $modulo)->pluck('moduloid');
	$permisoid = DB::table('authpermisos')->where('nombre', $permiso)->pluck('permisoid');

	//echo 'Modulo: '.$modulo.' - '.$moduloid.'<br />';
	//echo 'Permiso: '.$permiso.' - '.$permisoid.'<br />';
	
	//get modulo permiso
	$modulopermisoid = DB::table('authmodulopermisos')
											->where('moduloid', $moduloid)
											->where('permisoid', $permisoid)
											->pluck('modulopermisoid');
	//echo 'Modulopermiso: '.$modulopermisoid.'<br />';

	//get rol
	$rolid = Auth::user()->rolid;
	//echo 'Rol: '.$rolid.'<br />';

	//get rol modulo permiso
	$rolmodulopermisoid = DB::table('authrolmodulopermisos')
											->where('rolid', $rolid)
											->where('modulopermisoid', $modulopermisoid)
											->pluck('rolmodulopermisoid');
	//echo 'Rolmodulopermiso: '.$rolmodulopermisoid.'<br />';

	if($rolmodulopermisoid == ''){
		//return Redirect::to('accesodenegado');
		return View::make('cancerbero/accesodenegado');
	}

});

Route::filter('menu', function(){
	if(!Session::has('menu')){
			$elMenu    = new Menu;
			$menuItems = CSMenu::getMenuForRole();
			Session::put('menu', $elMenu->generarMenu($menuItems));
	}		
});