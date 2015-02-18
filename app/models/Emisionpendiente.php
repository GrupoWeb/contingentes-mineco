<?php

class Emisionpendiente extends Eloquent {
	protected $table      = 'solicitudesemision';
	protected $primaryKey = 'solicitudemisionid';

	public static function getSolicitudPendiente($id){
		return DB::table('solicitudesemision AS se')
			->select('u.nombre','u.email','se.created_at', 'se.usuarioid', 'se.solicitado', 
				't.nombrecorto AS tratado', 't.nombre AS tratadolargo', 
				'd.nombre AS producto','m.nombrecorto AS unidad', 'u.domiciliocomercial',
				'u.nit', 'u.telefono', 't.textocertificado','pa.nombre',
				DB::raw('(SELECT CONCAT(cp.partida," ",cp.nombre) FROM solicitudemisionpartidas AS sep 
					LEFT JOIN contingentepartidas as cp ON sep.partidaid = cp.partidaid
					WHERE sep.solicitudemisionid = se.solicitudemisionid LIMIT 1) AS fraccion'),
				DB::raw('(SELECT DATE_ADD(NOW(), INTERVAL t.mesesvalidez MONTH)) AS vencimiento'))
			->leftJoin('authusuarios AS u', 'se.usuarioid', '=', 'u.usuarioid')
			->leftJoin('periodos AS p', 'se.periodoid', '=', 'p.periodoid')
			->leftJoin('contingentes AS c', 'p.contingenteid', '=', 'c.contingenteid')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS d', 'c.productoid', '=', 'd.productoid')
			->leftJoin('unidadesmedida AS m', 'd.unidadmedidaid', '=', 'm.unidadmedidaid')
			->leftJoin('paises AS pa', 't.paisid', '=', 'pa.paisid')
			->where('se.solicitudemisionid',$id)
			->first();
	}
}