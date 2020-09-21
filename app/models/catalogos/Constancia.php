<?php

class Constancia extends Eloquent
{

    protected $primaryKey = 'constanciaid';

    public static function getConstancias($aPeridoId)
    {
        return DB::table('constancias AS c')
            ->select('m.cantidad', 'm.comentario', 'c.archivo',
                DB::raw("DATE_FORMAT(c.created_at, '%d-%m-%Y %H:%i') AS fecha"))
            ->leftJoin('movimientos AS m', 'c.movimientoid', '=', 'm.movimientoid')
            ->where('m.periodoid', $aPeridoId)
            ->get();
    }
}
