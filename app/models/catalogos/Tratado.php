<?php

class Tratado extends Eloquent {
	protected $primaryKey = 'tratadoid';

	public static function getTratados() {
		return DB::table('tratados')
			->select('tratadoid', 'nombre', 'nombrecorto', 'tipo')
			->whereRaw('tratadoid IN (SELECT DISTINCT tratadoid FROM contingentes)')
			->get();
	}

	public static function getNombre($aTratadoId) {
		return DB::table('tratados')
			->where('tratadoid', $aTratadoId)
			->pluck('nombrecorto');
	}

	public static function getEmpresasTratado($aTratadoId, $aContingenteId=0) {
		$query = DB::table('empresacontingentes AS ec')
			->select('e.razonsocial AS empresa', 'e.nit', 't.nombrecorto AS tratado', 
				'p.nombre AS producto', 'e.domiciliocomercial', 'e.telefono',
				DB::raw('DATE_FORMAT(ec.created_at, "%d-%m-%Y %H:%i") AS fechainscripcion'))
			->leftJoin('empresas AS e', 'e.empresaid','=','ec.empresaid')
			->leftJoin('contingentes AS c', 'ec.contingenteid', '=', 'c.contingenteid')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid');

		if($aTratadoId <> 0)
			$query->where('t.tratadoid', $aTratadoId);

		if($aContingenteId <> 0)
			$query->where('c.contingenteid', $aContingenteId);

		$query->orderBy('t.nombrecorto');
		$query->orderBy('p.nombre');
		$query->orderBy('e.razonsocial');

		return $query->get();
	}

	public static function getTratadosDashboard() {
		return DB::table('tratados AS t')
			->select('tratadoid', 'nombrecorto')
			->orderBy('nombrecorto')
			->get();
	}

	public static function getTratadoDashboard($aTratadoId) {
		return DB::table('tratados AS t')
			->select('nombre', 'tipo')
			->where('tratadoid', $aTratadoId)
			->first();
	}
}
