<?php

class Emisionpendiente extends Eloquent {
	protected $table      = 'solicitudesemision';
	protected $primaryKey = 'solicitudemisionid';

	/*public static function getSolicitudesPendientes(){
		return DB::table('solicitudesemision AS se')
			->select('u.nombre','u.email','u.created_at', 'p.nombre', 'u.usuarioid')
			->leftJoin('usuariocontingentes AS uc','u.usuarioid','=','uc.usuarioid')
			->leftJoin('contingentes AS c', 'uc.contingenteid', '=', 'c.contingenteid')
			->leftJoin('productos AS p','c.productoid', '=', 'p.productoid')
			->where('u.activo', 0)
			->get();
	}*/

	public static function getSolicitudPendiente($id){
		return DB::table('solicitudesemision AS se')
			->select('u.nombre','u.email','se.created_at', 'se.usuarioid', 'se.solicitado', 't.nombre AS tratado', 'p.nombre AS periodo', 'd.nombre AS producto','m.nombrecorto AS unidad')
			->leftJoin('authusuarios AS u', 'se.usuarioid', '=', 'u.usuarioid')
			->leftJoin('periodos AS p', 'se.periodoid', '=', 'p.periodoid')
			->leftJoin('contingentes AS c', 'p.contingenteid', '=', 'c.contingenteid')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS d', 'c.productoid', '=', 'd.productoid')
			->leftJoin('unidadesmedida AS m', 'd.unidadmedidaid', '=', 'm.unidadmedidaid')
			->where('se.solicitudemisionid',$id)
			->first();
	}
}