<?php

class Usuariocontingente extends Eloquent {

	protected $primaryKey = 'usuariocontingenteid';

	public static function getContingentes() {
		return DB::table('usuariocontingentes AS uc')
			->select('uc.contingenteid', 't.nombre AS tratado', 'p.nombre AS producto')
			->leftJoin('contingentes AS c', 'uc.contingenteid', '=', 'c.contingenteid')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->where('uc.usuarioid', Auth::id())
			->get();
	}
}
