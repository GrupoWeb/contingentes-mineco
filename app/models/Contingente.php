<?php

class Contingente extends Eloquent {

	protected $primryKey = 'contingenteid';
	protected $fillable = array('tratadoid');

	public static function getContingentes() {
		return DB::table('contingentes AS c')
			->select('contingenteid','t.nombrecorto AS tratado','p.nombre AS producto')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->orderBy('t.nombre')
			->orderBy('p.nombre')
			->get();
	}

	public static function getUnidadMedida($aContingenteId) {
		return DB::table('contingentes AS c')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->leftJoin('unidadesmedida AS u', 'p.unidadmedidaid', '=', 'u.unidadmedidaid')
			->pluck('u.nombrecorto');
	}

	public static function getNombre($aContingenteId) {
		return DB::table('contingentes AS c')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->selectRaw('CONCAT(t.nombrecorto, " - ", p.nombre) AS nombre')
			->where('c.contingenteid', $aContingenteId)
			->first();
	}
}
