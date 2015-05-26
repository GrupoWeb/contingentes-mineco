<?php

class Asignacionrequerimiento extends Eloquent {
	protected $table      = 'solicitudasignacionrequerimientos';
	protected $primaryKey = 'solicitudasignacionrequerimientoid';

	public static function getRequerimientos($id){
		return DB::table('solicitudasignacionrequerimientos AS ser')
			->select('ser.archivo','r.nombre', 'ser.solicitudasignacionrequerimientoid')
			->leftJoin('requerimientos AS r','ser.requerimientoid','=','r.requerimientoid')
			->where('ser.solicitudasignacionid',$id)
			->get();
	}

	public static function getArchivos($aId) {
		return DB::table('solicitudasignacionrequerimientos AS sar')
			->select('r.nombre', 'sar.archivo', 'sa.usuarioid',
				DB::raw('DATE_FORMAT(sar.created_at, "%d-%m-%Y %H:%i") AS fecha'))
			->leftJoin('requerimientos AS r', 'sar.requerimientoid', '=', 'r.requerimientoid')
			->leftJoin('solicitudasignacion AS sa', 'sar.solicitudasignacionid', '=', 'sa.solicitudasignacionid')
			->where('sar.solicitudasignacionid', $aId)
			->get();
	}
}