<?php

class Movimiento extends Eloquent {
	protected $primryKey = 'movimientoid';

	public static function getCuentaCorriente() {
		return DB::table('movimientos AS m')
			->select(DB::raw('DATE_FORMAT(m.created_at, "%d-%m-%Y") AS fecha'), 'u.nombre AS acreditadoa', 'u2.nombre AS acreditadopor', 'comentario', 'cantidad')
			->leftJoin('authusuarios AS u', 'm.usuarioid',  '=', 'u.usuarioid')
			->leftJoin('authusuarios AS u2', 'm.created_by', '=', 'u2.usuarioid')
			->orderBy('m.created_at')
			->get();
	}
}