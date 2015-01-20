<?php

class Tratado extends Eloquent {
	protected $primaryKey = 'tratadoid';

	public static function getNombre($aTratadoId) {
		return DB::table('tratados')
			->where('tratadoid', $aTratadoId)
			->pluck('nombrecorto');
	}
}
