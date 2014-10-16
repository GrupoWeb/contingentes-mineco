<?php

class Productorequerimiento extends Eloquent {

	protected $primryKey = 'priid';

	public static function getRequerimientos($aProducto){
		return DB::table('productorequerimientos AS pr')
			->select('priid', 'nombre')
			->leftJoin('requerimientos AS r', 'pr.requerimientoid', '=', 'r.requerimientoid')
			->where('productoid', $aProducto)
			->orderBy('priid')
			->get();
	}
}