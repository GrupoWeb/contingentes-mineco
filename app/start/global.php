<?php

ClassLoader::addDirectories(array(
	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

Log::useFiles(storage_path().'/logs/laravel.log');

App::missing(function($exception) {
  return View::make('components::404');
});

App::error(function(Exception $exception, $code) {
	if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
    Log::error('NotFoundHttpException Route: ' . Request::url() );
  }
  else if ($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
    Log::error('MethodNotAllowedHttpException Route: ' . Request::url() );
  }
  Log::error($exception);

  //if(App::environment() <> 'local')
    Hermes::notificarError($code, $exception->getMessage(), Request::url());
});

App::down(function() {
	return Response::make("Be right back!", 503);
});

require app_path().'/filters.php';
