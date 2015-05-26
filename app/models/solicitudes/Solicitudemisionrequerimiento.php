<?php

class Solicitudemisionrequerimiento extends Eloquent {
	protected $primaryKey = 'solicitudemisionrequerimientoid';

	public static function getEmisionRequerimientos($id){
		return DB::table('solicitudemisionrequerimientos AS ser')
			->select('ser.archivo','r.nombre', 'ser.solicitudemisionrequerimientoid')
			->leftJoin('requerimientos AS r','ser.requerimientoid','=','r.requerimientoid')
			->where('ser.solicitudemisionid',$id)
			->get();
	}

	public static function getArchivos($aId) {
		return DB::table('solicitudemisionrequerimientos AS ser')
			->select('r.nombre', 'ser.archivo', 'se.usuarioid',
				DB::raw('DATE_FORMAT(ser.created_at, "%d-%m-%Y %H:%i") AS fecha'))
			->leftJoin('requerimientos AS r', 'ser.requerimientoid', '=', 'r.requerimientoid')
			->leftJoin('solicitudesemision AS se', 'ser.solicitudemisionid', '=', 'se.solicitudemisionid')
			->where('ser.solicitudemisionid', $aId)
			->get();
	}
}