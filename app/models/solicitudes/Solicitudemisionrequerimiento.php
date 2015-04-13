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
}