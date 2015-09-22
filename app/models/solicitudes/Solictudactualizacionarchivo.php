<?php

class Solictudactualizacionarchivo extends Eloquent {

	protected $primaryKey = 'id';
	protected $table      = 'solicitudactualizacionrequerimientos';

	public static function getArchivosActualizacion($aActualizacion) {
		return DB::table('solicitudactualizacionrequerimientos')
			->where('actualizacionid', $aActualizacion)
			->lists('archivo');
	}
}