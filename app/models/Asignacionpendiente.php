<?php

class Asignacionpendiente extends Eloquent {
	protected $table      = 'solicitudasignacion';
	protected $primaryKey = 'solicitudasignacionid';

	public static function getSolicitudPendiente($id){
		return DB::table('solicitudasignacion AS se')
			->select('u.nombre','u.email','se.created_at', 'se.usuarioid', 'se.solicitado', 
				't.nombrecorto AS tratado', 't.nombre AS tratadolargo', 
				'd.nombre AS producto','m.nombrecorto AS unidad', 'u.domiciliocomercial',
				'u.nit', 'u.telefono',
				DB::raw('(SELECT DATE_ADD(NOW(), INTERVAL t.mesesvalidez MONTH)) AS vencimiento'))
			->leftJoin('authusuarios AS u', 'se.usuarioid', '=', 'u.usuarioid')
			->leftJoin('periodos AS p', 'se.periodoid', '=', 'p.periodoid')
			->leftJoin('contingentes AS c', 'p.contingenteid', '=', 'c.contingenteid')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS d', 'c.productoid', '=', 'd.productoid')
			->leftJoin('unidadesmedida AS m', 'd.unidadmedidaid', '=', 'm.unidadmedidaid')
			->where('se.solicitudasignacionid',$id)
			->first();
	}
}