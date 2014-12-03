<?php

class Periodo extends Eloquent {

	protected $primryKey = 'periodoid';

	public static function getPeriodo($aContingenteId) {
		return DB::table('periodos')
			->whereRaw('DATE(NOW()) BETWEEN fechainicio AND fechafin')
			->where('contingenteid', $aContingenteId)
			->pluck('periodoid');
	}
}
