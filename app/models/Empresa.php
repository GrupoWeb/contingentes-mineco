<?php

class Empresa extends Eloquent {

	protected $primaryKey = 'authusuarios';

	public static function getEmpresas($contingenteid, $fechaini, $fechafin) {
		return DB::table('authusuarios AS u')
			->select(DB::raw('DATE_FORMAT(uc.created_at, "%d-%m-%Y") AS fecha'),'uc.contingenteid', 'p.nombre AS producto', 'u.nombre','t.nombrecorto AS tratado')
			->leftJoin('authroles AS rol', 'rol.rolid', '=', 'u.rolid')
			->leftJoin('usuariocontingentes AS uc', 'uc.usuarioid', '=', 'u.usuarioid')
  			->leftJoin('contingentes AS c', 'c.contingenteid', '=', 'uc.contingenteid')
  			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->where('rol.nombre', "Empresa")
			->where('uc.contingenteid', $contingenteid)
            ->whereBetween('uc.created_at', array($fechaini, $fechafin))
			->get();
	}
}
