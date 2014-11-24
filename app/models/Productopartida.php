<?php

class Productopartida extends Eloquent {

	protected $primryKey = 'partidaid';

	public static function getPartidas($aProductoId) {
		return DB::table('productopartidas')
			->select('nombre','partida','partidaid')
			->orderBy('partida')
			->where('productoid', $aProductoId)
			->where('activo', 1)
			->get();
	}
}
