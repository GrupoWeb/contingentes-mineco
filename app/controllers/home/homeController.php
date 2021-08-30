<?php

class homeController extends BaseController
{
    public function index()
    {
        //verifica retorno
        if (Auth::check()) {
            return Redirect::to('inicio');
        } else {
            //retornar a la vista
            return View::make('home/index');
        }
    }

    public function acuerdoscomerciales()
    {
        //retorna datos a la vista
        return View::make('home/acuerdoscomerciales')
            ->with('contingentes', Contingente::getContingentes());
    }

    public function manuales()
    {
        //retorna vista
        return View::make('home/manuales');
    }
}
