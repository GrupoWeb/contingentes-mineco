<?php

class Tipotratado extends Eloquent {
	protected $primaryKey = 'tipotratadoid';

	public static function getAsignacion($aTipoTratadoId) {
		return DB::table('tipotratados')
			->where('tipotratadoid', $aTipoTratadoId)
			->pluck('asignacion');
	}
}
