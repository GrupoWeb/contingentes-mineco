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
require app_path() . '/filters.php';
