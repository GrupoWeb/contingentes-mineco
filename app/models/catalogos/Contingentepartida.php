<?php

class Contingentepartida extends Eloquent {

	protected $primryKey = 'partidaid';

	public static function getPartidas($aContingenteId) {
		return DB::table('contingentepartidas')
			->select('nombre','partida','partidaid')
			->orderBy('partida')
			->where('contingenteid', $aContingenteId)
			->where('activa', 1)
			->get();
	}
}
