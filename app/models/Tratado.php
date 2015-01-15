<?php

class Tratado extends Eloquent {
	protected $primryKey = 'tratadoid';

	public static function getNombre($aTratadoId) {
		return DB::table('tratados')
			->where('tratadoid', $aTratadoId)
			->pluck('nombrecorto');
	}
}
