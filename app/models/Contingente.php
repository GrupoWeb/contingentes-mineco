<?php

class Contingente extends Eloquent {

	protected $primaryKey = 'contingenteid';
	protected $guarded    = array('contingenteid');

	public static function getContingentes() {
		return DB::table('contingentes AS c')
			->select('contingenteid','t.nombrecorto AS tratado','p.nombre AS producto', 't.tipo')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->orderBy('t.tipo','DESC')
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

	public static function getContingentesTratado($aTratadoId) {
		return DB::table('contingentes')
			->where('tratadoid', $aTratadoId)
			->lists('contingenteid');
	}
}
