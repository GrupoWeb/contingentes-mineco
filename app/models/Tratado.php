<?php

class Tratado extends Eloquent {
	protected $primaryKey = 'tratadoid';

	public static function getTratados() {
		return DB::table('tratados')
			->select('tratadoid', 'nombre', 'nombrecorto', 'tipo')
			->get();
	}

	public static function getNombre($aTratadoId) {
		return DB::table('tratados')
			->where('tratadoid', $aTratadoId)
			->pluck('nombrecorto');
	}

	public static function getUsuariosTratado($aTratadoId) {
		$query = DB::table('usuariocontingentes AS uc')
			->select('u.nombre AS empresa', 'u.email', 'u.nit', 't.nombrecorto AS tratado', 
				'p.nombre AS producto', 'u.domiciliocomercial', 'u.telefono',
				DB::raw('DATE_FORMAT(uc.created_at, "%d-%m-%Y %H:%i") AS fechainscripcion'))
			->leftJoin('authusuarios AS u', 'uc.usuarioid', '=', 'u.usuarioid')
			->leftJoin('contingentes AS c', 'uc.contingenteid', '=', 'c.contingenteid')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid');

		if($aTratadoId <> 0)
			$query->where('t.tratadoid', $aTratadoId);

		$query->orderBy('t.nombrecorto');
		$query->orderBy('p.nombre');
		$query->orderBy('u.nombre');

		return $query->get();
	}
}
