<?php

class Inscripcionpendiente extends Eloquent {
	protected $table      = 'authusuarios';
	protected $primaryKey = 'usuarioid';

	public static function getSolicitudesPendientes(){
		return DB::table('authusuarios AS u')
			->select('u.nombre','u.email','u.created_at', 'p.nombre', 'u.usuarioid')
			->leftJoin('usuariocontingentes AS uc','u.usuarioid','=','uc.usuarioid')
			->leftJoin('contingentes AS c', 'uc.contingenteid', '=', 'c.contingenteid')
			->leftJoin('productos AS p','c.productoid', '=', 'p.productoid')
			->where('u.activo', 0)
			->get();
	}

	public static function getSolicitudPendiente($id){
		return DB::table('authusuarios AS u')
			->select('u.nombre','u.email','u.created_at', 'u.usuarioid',
				DB::raw('(SELECT GROUP_CONCAT( CONCAT(t.nombre, " - ", p.nombre) SEPARATOR "<br>") FROM usuariocontingentes uc 
					LEFT JOIN contingentes AS c USING(contingenteid)
					LEFT JOIN tratados AS t USING(tratadoid)
					LEFT JOIN productos p USING(productoid) 
					WHERE uc.usuarioid=u.usuarioid) AS productos'))
			->where('u.usuarioid',$id)
			->first();
	}
}