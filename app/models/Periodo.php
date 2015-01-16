<?php

class Periodo extends Eloquent {

	protected $primryKey = 'periodoid';

	public static function getPeriodo($aContingenteId) {
		return DB::table('periodos')
			->whereRaw('DATE(NOW()) BETWEEN fechainicio AND fechafin')
			->where('contingenteid', $aContingenteId)
			->pluck('periodoid');
	}

	public static function getPeridoAsignacion($aPeriodoId) {
		return DB::table('periodos AS p')
			->select('p.periodoid', 'p.nombre AS periodo', 't.nombrecorto AS tratado', 'c.tipotratadoid', 'tt.nombre AS tipo','pr.nombre AS producto')
			->leftJoin('contingentes AS c', 'p.contingenteid', '=', 'c.contingenteid')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('tipotratados AS tt', 'c.tipotratadoid', '=', 'tt.tipotratadoid')
			->leftJoin('productos AS pr', 'c.productoid', '=', 'pr.productoid')
			->where('p.periodoid', $aPeriodoId)
			->first();
	}
}
