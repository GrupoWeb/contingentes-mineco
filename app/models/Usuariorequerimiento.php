<?php

class Usuariorequerimiento extends Eloquent {

	protected $primaryKey = 'usuariorequerimientoid';
	protected $table = 'usuariorequerimientos';

	public static function getUsuarioRequerimientos($id){
		return DB::table('usuariorequerimientos As ur')
			->select('ur.archivo','r.nombre', 'ur.usuarioid')
			->leftJoin('requerimientos As r','r.requerimientoid','=','ur.requerimientoid')
			->where('ur.usuarioid',$id)
			->get();
	}

	public static function getSolicitudPendiente($id){
		return DB::table('authusuarios As u')
			->select('u.nombre','u.email','u.created_at', 'p.nombre')
			->leftJoin('usuarioproductos As up','up.usuarioid','=','u.usuarioid')
			->leftJoin('productos As p','p.productoid','=','up.productoid')
			->where('u.usuarioid',$id)
			->get();
	}
}