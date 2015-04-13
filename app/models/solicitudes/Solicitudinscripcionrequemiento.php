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

}
