<?php

class Solicitudautorizacion extends Eloquent {

	protected $primaryKey = 'solicitudautorizacionid';
	protected $table      = 'solicitudautorizacion';

	public static function getPendientes($aUsuario) {
		return DB::table('solicitudautorizacion')
		->select('usuarioid', 'nit', 'estado')
		->where('estado', '=', 'Pendiente')
		->first();
	}

}
