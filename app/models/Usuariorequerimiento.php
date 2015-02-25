<?php

class Usuariorequerimiento extends Eloquent {

	protected $primaryKey = 'usuariorequerimientoid';
	protected $table = 'usuariorequerimientos';

	public static function getUsuarioRequerimientos($id){
		return DB::table('usuariorequerimientos As ur')
			->select('ur.archivo','r.nombre', 'ur.usuarioid','r.requerimientoid')
			->leftJoin('requerimientos As r','r.requerimientoid','=','ur.requerimientoid')
			->where('ur.usuarioid',$id)
			->get();
	}	
	/*public static function getUsuarioContingenteRequerimientos($id,$contingenteid){
		return DB::table('usuariorequerimientos As ur')
			->select('ur.archivo','r.nombre', 'ur.usuarioid','uc.contingenteid')
			->leftJoin('requerimientos As r','r.requerimientoid','=','ur.requerimientoid')
			->leftJoin('usuariocontingentes As uc','ur.usuarioid','=','uc.usuarioid')
			->where('ur.usuarioid',$id)
			->where('uc.contingenteid',$contingenteid)
			->whereRaw("ur.requerimientoid IN (SELECT requerimientoid FROM contingenterequerimientos cr WHERE cr.contingenteid=$contingenteid)")
			->get();
	}

	public static function getSolicitudPendiente($id){
		return DB::table('authusuarios As u')
			->select('u.nombre','u.email','u.created_at', 'p.nombre')
			->leftJoin('usuarioproductos As up','up.usuarioid','=','u.usuarioid')
			->leftJoin('productos As p','p.productoid','=','up.productoid')
			->where('u.usuarioid',$id)
			->get();
	}*/
}