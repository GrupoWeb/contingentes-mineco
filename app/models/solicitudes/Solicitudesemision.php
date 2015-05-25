<?php

class Solicitudesemision extends Eloquent {
	protected $table     = 'solicitudesemision';
	protected $primaryKey = 'solicitudesemisionid';

	public static function getSolicitudes($aContingentes) {
		return DB::table('solicitudesemision AS sa')
			->select(DB::raw('COUNT(*) as cuenta'), 'estado')
			->leftJoin('periodos AS p', 'sa.periodoid', '=', 'p.periodoid')
			->whereIn('contingenteid', $aContingentes)
			->groupBy('estado')
			->orderBy('estado')
			->get();
	}

	public static function getEmisionesUsuario($aUsuarioId) {
		return DB::table('solicitudesemision')
			->where('usuarioid', $aUsuarioId)
			->count();
	}

	public static function getSolicitud($aSolicitudId) {
		return DB::table('solicitudesemision AS se')
			->select('u.nombre', 'u.email', 't.nombrecorto AS tratado', 'estado',
				DB::raw('DATE_FORMAT(se.created_at, "%d-%m-%Y %H:%i") AS fecha'))
			->leftJoin('authusuarios AS u', 'se.usuarioid', '=', 'u.usuarioid')
			->leftJoin('periodos AS p', 'se.periodoid', '=', 'p.periodoid')
			->leftJoin('contingentes AS c', 'p.contingenteid', '=', 'c.contingenteid')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->where('solicitudemisionid', $aSolicitudId)
			->first();
	}
}