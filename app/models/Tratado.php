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
		return DB::table('usuariocontingentes AS uc')
			->leftJoin('authusuarios AS u', 'uc.usuarioid', '=', 'u.usuarioid')
			->leftJoin('contingentes AS c', 'uc.contingenteid', '=', 'c.contingenteid')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->where('t.tratadoid', $aTratadoId)
			->get();
	}
}
