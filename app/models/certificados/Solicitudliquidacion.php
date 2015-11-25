<?php

class Solicitudliquidacion extends Eloquent {
	
	protected $table      = 'solicitudesliquidacion';
	protected $primaryKey = 'solicitudliquidacionid';

	public static function getSolicitud($aSolicitudId) {
		return DB::table('solicitudesliquidacion AS sl')
			->select('sl.dua', 'sl.real', 'sl.cif', 'sl.documento',
				'u.nombre', 'e.razonsocial AS empresa', 'c.numerocertificado',
				'c.volumen', 'c.fraccion', 'u.email', 'u.usuarioid', 'solicitudliquidacionid AS id',
				DB::raw('DATE_FORMAT(sl.fechaliquidacion, "%d-%m-%Y %H:%i") AS fecha'))
			->leftJoin('authusuarios AS u', 'sl.usuarioid', '=', 'u.usuarioid')
			->leftJoin('empresas AS e', 'u.empresaid', '=', 'e.empresaid')
			->leftJoin('certificados AS c', 'sl.certificadoid', '=', 'c.certificadoid')
			->where('sl.solicitudliquidacionid', $aSolicitudId)
			->first();
	}
}