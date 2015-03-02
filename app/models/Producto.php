<?php

class Producto extends Eloquent {

	protected $primaryKey = 'productoid';

	public static function getProductos() {
		return DB::table('productos')
			->select('nombre','productoid')
			->orderBy('nombre')
			->where('activo', 1)
			->get();
	}

	public static function getNombre($aProductoId) {
		return DB::table('productos')
			->where('productoid', $aProductoId)
			->pluck('nombre');
	}
}
