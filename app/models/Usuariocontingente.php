<?php

class Usuariocontingente extends Eloquent {

	protected $primaryKey = 'usuariocontingenteid';

	public static function getContingentes($asignacion=false) {
		$query = DB::table('usuariocontingentes AS uc')
			->select('uc.contingenteid', 't.nombrecorto AS tratado', 'p.nombre AS producto', 'c.tratadoid')
			->leftJoin('contingentes AS c', 'uc.contingenteid', '=', 'c.contingenteid')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->where('uc.usuarioid', Auth::id());

		if($asignacion)
			$query->where('asignacion', 1);

		return $query->get();
	}
}
