<?php

class Solicitudasignacion extends Eloquent {
	protected $table     = 'solicitudasignacion';
	protected $primryKey = 'solicitudasignacionid';

	public static function getSolicitudes($aContingentes) {
		return DB::table('solicitudasignacion AS sa')
			->select(DB::raw('COUNT(*) as cuenta'), 'estado')
			->leftJoin('periodos AS p', 'sa.periodoid', '=', 'p.periodoid')
			->whereIn('contingenteid', $aContingentes)
			->groupBy('estado')
			->orderBy('estado')
			->get();
	}
}
