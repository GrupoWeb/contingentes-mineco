<?php

class Producto extends Eloquent {

	protected $primryKey = 'productoid';
	protected $fillable = array('nombre');

	public static function getProductos() {
		return DB::table('productos')
			->select('nombre','productoid')
			->orderBy('nombre')
			->where('activo', 1)
			->get();
	}
}
