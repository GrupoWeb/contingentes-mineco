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
			->select('p.periodoid', DB::raw('CONCAT(t.nombrecorto," - ",pr.nombre, " - ",YEAR(p.fechainicio)) AS periodo'), 't.nombrecorto AS tratado', 'c.tipotratadoid', 'tt.nombre AS tipo','pr.nombre AS producto')
			->leftJoin('contingentes AS c', 'p.contingenteid', '=', 'c.contingenteid')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('tipotratados AS tt', 'c.tipotratadoid', '=', 'tt.tipotratadoid')
			->leftJoin('productos AS pr', 'c.productoid', '=', 'pr.productoid')
			->where('p.periodoid', $aPeriodoId)
			->first();
	}

	public static function getPeriodosContingente($aContingenteId) {
		return DB::table('periodos')
			->select('periodoid', DB::raw('YEAR(fechainicio) AS nombre'))
			->where('contingenteid', $aContingenteId)
			->get();
	}
}
