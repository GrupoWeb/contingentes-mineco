<?php

class Solicitudasignacion extends Eloquent {
	protected $table     = 'solicitudasignacion';
	protected $primaryKey = 'solicitudasignacionid';

	public static function getSolicitudes($aContingentes) {
		return DB::table('solicitudasignacion AS sa')
			->select(DB::raw('COUNT(*) as cuenta'), 'estado')
			->leftJoin('periodos AS p', 'sa.periodoid', '=', 'p.periodoid')
			->whereIn('contingenteid', $aContingentes)
			->groupBy('estado')
			->orderBy('estado')
			->get();
	}

	public static function getSolicitud($aSolicitudId) {
		return DB::table('solicitudasignacion AS sa')
			->select('u.nombre', 'u.email', 't.nombrecorto AS tratado', 'estado',
				DB::raw('DATE_FORMAT(sa.created_at, "%d-%m-%Y %H:%i") AS fecha'))
			->leftJoin('authusuarios AS u', 'sa.usuarioid', '=', 'u.usuarioid')
			->leftJoin('periodos AS p', 'sa.periodoid', '=', 'p.periodoid')
			->leftJoin('contingentes AS c', 'p.contingenteid', '=', 'c.contingenteid')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->where('solicitudasignacionid', $aSolicitudId)
			->first();
	}

	public static function getIndicadores($aContingenteId, $aEmpresaId) {
		return DB::table('solicitudasignacion AS sa')
			->select('sa.solicitado', 'sa.asignado', 'sa.acta', 'sa.observaciones',
				DB::raw("date_format(sa.created_at, '%d-%m-%Y %H:%i') AS fechasolicitud"),
				DB::raw("date_format(sa.updated_at, '%d-%m-%Y %H:%i') AS fechaprocesamiento"))
			->leftJoin('periodos AS p', 'sa.periodoid', '=', 'p.periodoid')
			->leftJoin('authusuarios AS u', 'sa.usuarioid', '=', 'u.usuarioid')
			->where('estado', 'Aprobada')
			->where('p.contingenteid', $aContingenteId)
			->where('u.empresaid', $aEmpresaId)
			->get();
	}
}


