<?php

class Pais extends Eloquent
{
    protected $table      = 'paises';
    protected $primaryKey = 'paisid';

    public static function getPaises()
    {
        return self::select('paisid', 'nombre')
            ->orderBy('nombre')
            ->get();
    }
}
