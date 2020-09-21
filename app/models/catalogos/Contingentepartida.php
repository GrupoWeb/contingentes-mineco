<?php

class Contingentepartida extends Eloquent
{

    protected $primaryKey = 'partidaid';

    public static function getPartidas($aContingenteId)
    {
        return DB::table('contingentepartidas')
            ->select('nombre', 'partida', 'partidaid')
            ->orderBy('partida')
            ->where('contingenteid', $aContingenteId)
            ->where('activa', 1)
            ->get();
    }

    public static function listPartidas($aContingenteId)
    {
        return DB::table('contingentepartidas')
            ->orderBy('partida')
            ->where('contingenteid', $aContingenteId)
            ->where('activa', 1)
            ->lists('partida');
    }
}
