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

App::missing(function ($exception) {
    return View('errors.error')->with('message', 'La página que busca no fue encontrada');
});

App::error(function (Exception $exception) {
    Log::error($exception);

    return View('errors.error')->with('message', $exception->getMessage());
});

require app_path() . '/filters.php';
