<?php

class Solicitudinscripcionrequemiento extends Eloquent {
	protected $table      = 'solicitudinscripcionrequemientos';
	protected $primaryKey = 'solicitudinscripcionrequerimientoid';

	public static function getRequerimientosSolicitud($aSolicitudId) {
		return DB::table('solicitudinscripcionrequemientos AS sir')
			->select('sir.archivo', 'r.nombre', 'sir.solicitudinscripcionid') //contingenteid?
			->leftJoin('requerimientos AS r', 'sir.requerimientoid', '=', 'r.requerimientoid')
			->where('sir.solicitudinscripcionid', $aSolicitudId)
			->get();
	}

	public static function getArchivos($aId) {
		return DB::table('solicitudinscripcionrequemientos AS sir')
			->select('r.nombre', 'sir.archivo', 'sir.solicitudinscripcionid',
				DB::raw('DATE_FORMAT(sir.created_at, "%d-%m-%Y %H:%i") AS fecha'))
			->leftJoin('requerimientos AS r', 'sir.requerimientoid', '=', 'r.requerimientoid')
			->where('sir.solicitudinscripcionid', $aId)
			->get();
	}
}