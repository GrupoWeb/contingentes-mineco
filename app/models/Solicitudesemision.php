<?php

class Solicitudesemision extends Eloquent {
	protected $table     = 'solicitudesemision';
	protected $primaryKey = 'Solicitudesemisionid';

	public static function getSolicitudes($aContingentes) {
		return DB::table('solicitudesemision AS sa')
			->select(DB::raw('COUNT(*) as cuenta'), 'estado')
			->leftJoin('periodos AS p', 'sa.periodoid', '=', 'p.periodoid')
			->whereIn('contingenteid', $aContingentes)
			->groupBy('estado')
			->orderBy('estado')
			->get();
	}
}
