<?php

class Inscripcionpendiente extends Eloquent {
	protected $table      = 'usuariocontingentes';
	protected $primaryKey = 'usuariocontingenteid';

	public static function getSolicitudesPendientes(){
		return DB::table('authusuarios AS u')
			->select('u.nombre','u.email','u.created_at', 'p.nombre AS producto', 'u.usuarioid','c.contingenteid','u.activo')
			->leftJoin('usuariocontingentes AS uc','u.usuarioid','=','uc.usuarioid')
			->leftJoin('contingentes AS c', 'uc.contingenteid', '=', 'c.contingenteid')
			->leftJoin('productos AS p','c.productoid', '=', 'p.productoid')
			->where('uc.activo', 0)
			->get();
	}

	public static function getSolicitudPendiente($id,$contingenteid){
		return DB::table('authusuarios AS u')
			->select('u.nombre','u.email','u.created_at', 'u.usuarioid',
				DB::raw('(SELECT GROUP_CONCAT( CONCAT(t.nombre, " - ", p.nombre) SEPARATOR "<br>") FROM usuariocontingentes uc 
					LEFT JOIN contingentes AS c USING(contingenteid)
					LEFT JOIN tratados AS t USING(tratadoid)
					LEFT JOIN productos p USING(productoid) 
					WHERE uc.usuarioid=u.usuarioid AND c.contingenteid='.$contingenteid.') AS productos'))
			->where('u.usuarioid',$id)
			->first();
	}
}