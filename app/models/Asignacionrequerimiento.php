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
}