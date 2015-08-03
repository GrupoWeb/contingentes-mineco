<?php

class Solictudactualizacion extends Eloquent {

	protected $primaryKey = 'actualizacionid';
	protected $table      = 'solicitudactualizacion';

	public static function getPendientes($aUsuario) {
		return DB::table('solicitudactualizacion')
		->where('empresaid', $aUsuario)
		->where('estado', 'Pendiente')
		->first();
	}

}
