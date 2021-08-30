<?php

ClassLoader::addDirectories([
    app_path() . '/commands',
    app_path() . '/controllers',
    app_path() . '/models',
    app_path() . '/database/seeds',

]);

Log::useFiles(storage_path() . '/logs/laravel.log');

App::down(function () {
    return Response::view('template/mantenimiento', [], 503);
});

App::error(function (Exception $exception) {
    if (is_a($exception, 'Symfony\Component\HttpKernel\Exception\NotFoundHttpException')) {
        return View::make('errors.error')->with('message', 'La página que busca no fue encontrada');
    }

    Log::error($exception);

    return View::make('errors.error')->with('message', $exception->getMessage());
});

require app_path() . '/filters.php';
