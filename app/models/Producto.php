<?php

class Producto extends Eloquent {

	protected $primryKey = 'productoid';

	public static function getProductos() {
		return DB::table('productos')
			->select('nombre','productoid')
			->orderBy('nombre')
			->where('activo', 1)
			->get();
	}
}
