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

	public static function getEmisionesPendientes($aEmpresaId) {
		return DB::table('solicitudesemision AS s')
			->leftJoin('authusuarios AS u','u.usuarioid', '=','s.usuarioid')
			->where('u.empresaid', $aEmpresaId)
			->where('s.estado','Pendiente')
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

	public static function getIndicadores($aContingenteId, $aEmpresaId) {
		return DB::table('solicitudesemision AS se')
			->select('se.solicitado', 'se.emitido', 'se.observaciones', 'cp.partida',
				DB::raw("date_format(se.created_at, '%d-%m-%Y %H:%i') AS fechasolicitud"),
				DB::raw("date_format(se.updated_at, '%d-%m-%Y %H:%i') AS fechaprocesamiento"))
			->leftJoin('periodos AS p', 'se.periodoid', '=', 'p.periodoid')
			->leftJoin('authusuarios AS u', 'se.usuarioid', '=', 'u.usuarioid')
			->leftJoin('solicitudemisionpartidas AS sep', 'se.solicitudemisionid', '=', 'sep.solicitudemisionid')
			->leftJoin('contingentepartidas AS cp', 'sep.partidaid', '=', 'cp.partidaid')
			->where('estado', 'Aprobada')
			->where('p.contingenteid', $aContingenteId)
			->where('u.empresaid', $aEmpresaId)
			->get();
	}
}
