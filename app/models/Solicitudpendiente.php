<?php

class Solicitudpendiente extends Eloquent {

	protected $primaryKey = 'usuarioid';
	protected $table = 'authusuarios';

	public static function getSolicitudesPendientes(){
		return DB::table('authusuarios As u')
			->select('u.nombre','u.email','u.created_at', 'p.nombre')
			->leftJoin('usuarioproductos As up','up.usuarioid','=','u.usuarioid')
			->leftJoin('productos As p','p.productoid','=','up.productoid')
			->where('u.activo',0)
			->get();
	}

	public static function getSolicitudPendiente($id){
		return DB::table('authusuarios As u')
			->select('u.nombre','u.email','u.created_at', 'p.nombre', 'u.usuarioid')
			->leftJoin('usuarioproductos As up','up.usuarioid','=','u.usuarioid')
			->leftJoin('productos As p','p.productoid','=','up.productoid')
			->where('u.usuarioid',$id)
			->get();
	}
}