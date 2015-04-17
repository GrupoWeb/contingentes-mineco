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
}