<?php

class Requerimiento extends Eloquent {

	protected $primryKey = 'requerimientoid';

	public static function getRequerimientos() {
		return DB::table('requerimientos')
			->select('nombre','requerimientoid')
			->orderBy('nombre')
			->where('activo', 1)
			->get();
	}
}
