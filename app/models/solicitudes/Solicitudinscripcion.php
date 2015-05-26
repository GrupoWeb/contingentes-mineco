<?php

class Solicitudinscripcion extends Eloquent {
	protected $table      = 'solicitudinscripciones';
	protected $primaryKey = 'solicitudinscripcionid';

	public static function getSolicitudPendiente($aSolicitudId) {
		return DB::table('solicitudinscripciones AS si')
			->select('si.solicitudinscripcionid', 'email', 'nit', 'si.nombre', 'propietario', 'domiciliofiscal',
				'domiciliocomercial', 'direccionnotificaciones', 'telefono', 'fax', 'encargadoimportaciones',
				't.nombrecorto AS tratado', 'p.nombre AS producto', 'c.contingenteid',
				DB::raw('DATE_FORMAT(si.created_at, "%d-%m-%Y %h:%i") AS created_at'))
			->leftJoin('solicitudinscripcioncontingentes AS sic', 'si.solicitudinscripcionid', '=', 'sic.solicitudinscripcionid')
			->leftJoin('contingentes AS c', 'sic.contingenteid', '=', 'c.contingenteid')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->where('si.solicitudinscripcionid', $aSolicitudId)
			->first();
	}

	public static function getSolicitudes($aContingentes) {
		return DB::table('solicitudinscripciones AS si')
			->select(DB::raw('COUNT(*) as cuenta'), 'estado')
			->leftJoin('solicitudinscripcioncontingentes AS sic', 'si.solicitudinscripcionid', '=', 'sic.solicitudinscripcionid')
			->whereIn('contingenteid', $aContingentes)
			->groupBy('estado')
			->orderBy('estado')
			->get();
	}

	public static function getSolicitud($aSolicitudId) {
		return DB::table('solicitudinscripciones AS si')
			->select('si.nombre', 'si.email', 't.nombrecorto AS tratado', 'estado',
				DB::raw('DATE_FORMAT(si.created_at, "%d-%m-%Y %H:%i") AS fecha'))
			->leftJoin('solicitudinscripcioncontingentes AS sic', 'si.solicitudinscripcionid', '=', 'sic.solicitudinscripcionid')
			->leftJoin('contingentes AS c', 'sic.contingenteid', '=', 'c.contingenteid')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->where('si.solicitudinscripcionid', $aSolicitudId)
			->first();
	}
}