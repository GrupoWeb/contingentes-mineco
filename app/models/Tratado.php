<?php

class Tratado extends Eloquent {
	protected $primaryKey = 'tratadoid';

	public static function getTratados() {
		return DB::table('tratados')
			->select('tratadoid', 'nombre', 'nombrecorto', 'tipo')
			->get();
	}

	public static function getNombre($aTratadoId) {
		return DB::table('tratados')
			->where('tratadoid', $aTratadoId)
			->pluck('nombrecorto');
	}
}
