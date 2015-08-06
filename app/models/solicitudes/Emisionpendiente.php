<?php

class Emisionpendiente extends Eloquent {
	protected $table      = 'solicitudesemision';
	protected $primaryKey = 'solicitudemisionid';

	public static function getSolicitudPendiente($id){
		return DB::table('solicitudesemision AS se')
			->select('e.razonsocial AS nombre','u.email','se.created_at', 'se.usuarioid', 'se.solicitado', 
				't.nombrecorto AS tratado', 't.nombre AS tratadolargo', 'c.variacion', 'e.codigovupe', 'c.contingenteid',
				'd.nombre AS producto','m.nombrecorto AS unidad', 'e.domiciliocomercial', 'p.periodoid',
				'e.nit', 'e.telefono', 'c.textocertificado','se.paisid', 'pp.nombre AS pais', 'd.nombre AS producto', 'e.domiciliofiscal',
				DB::raw('(SELECT CONCAT(cp.partida," ",cp.nombre) FROM solicitudemisionpartidas AS sep 
					LEFT JOIN contingentepartidas as cp ON sep.partidaid = cp.partidaid
					WHERE sep.solicitudemisionid = se.solicitudemisionid LIMIT 1) AS fraccion'),
				DB::raw('(IF((SELECT DATE_ADD(NOW(), INTERVAL t.mesesvalidez MONTH)) > p.fechafin, CONCAT(p.fechafin," ",TIME((SELECT DATE_ADD(NOW(), INTERVAL t.mesesvalidez MONTH)))), (SELECT DATE_ADD(NOW(), INTERVAL t.mesesvalidez MONTH)))) AS vencimiento'))
			->leftJoin('authusuarios AS u', 'se.usuarioid', '=', 'u.usuarioid')
			->leftJoin('empresas AS e','e.empresaid','=','u.empresaid')
			->leftJoin('periodos AS p', 'se.periodoid', '=', 'p.periodoid')
			->leftJoin('contingentes AS c', 'p.contingenteid', '=', 'c.contingenteid')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS d', 'c.productoid', '=', 'd.productoid')
			->leftJoin('unidadesmedida AS m', 'd.unidadmedidaid', '=', 'm.unidadmedidaid')
			->leftJoin('paises AS pp', 'se.paisid', '=', 'pp.paisid')
			->where('se.solicitudemisionid',$id)
			->first();
	}
}