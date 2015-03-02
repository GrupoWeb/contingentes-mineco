<?php

class Pais extends Eloquent {
	protected $table     = 'paises';
	protected $primryKey = 'paisid';

	public static function getPaises() {
		return DB::table('paises')
			->select('paisid', 'nombre')
			->orderBy('nombre')
			->get();
	}
}