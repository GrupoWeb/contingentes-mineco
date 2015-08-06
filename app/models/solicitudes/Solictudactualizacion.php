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

	public static function getSolicitud($aSolicitudId) {
		return DB::table('solicitudactualizacion AS sa')
			->select('u.nombre', 'e.razonsocial', 'e.nit', 'sa.estado', 'sa.observaciones', 'sa.actualizacionid',
				DB::raw('DATE_FORMAT(sa.created_at, "%d-%m-%Y %H:%i") AS fecha'))
			->leftJoin('authusuarios AS u', 'sa.usuarioid', '=', 'u.usuarioid')
			->leftJoin('empresas AS e', 'sa.empresaid', '=', 'e.empresaid')
			->where('sa.actualizacionid', $aSolicitudId)
			->first();
	}
}
