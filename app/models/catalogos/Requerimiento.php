<?php

class Requerimiento extends Eloquent
{

    protected $primaryKey = 'requerimientoid';

    public static function getRequerimientos()
    {
        return self::select('nombre', 'requerimientoid')
            ->orderBy('nombre')
            ->get();
    }
}
