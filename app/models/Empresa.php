<?php

class Empresa extends Eloquent {

	protected $primaryKey = 'authusuarios';

	public static function getEmpresas($contingenteid, $fechaini, $fechafin) {
		return DB::table('authusuarios AS u')
			->select(DB::raw('DATE_FORMAT(u.created_at, "%d-%m-%Y") AS fecha'),'uc.contingenteid', 'p.nombre AS producto', 'u.nombre','t.nombrecorto AS tratado')
			->leftJoin('usuariocontingentes AS uc', 'uc.usuarioid', '=', 'u.usuarioid')
  			->leftJoin('contingentes AS c', 'c.contingenteid', '=', 'uc.contingenteid')
  			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->where('u.rolid', 3)
			->where('uc.contingenteid', $contingenteid)
            ->whereBetween('u.created_at', array($fechaini, $fechafin))
			->get();
	}

	public static function getActivaNit($aNit) {
		return DB::table('authusuarios')
			->whereIn('rolid', Config::get('contingentes.rolempresa') )
			->where( DB::raw('REPLACE(nit,"-","")'), str_replace('-', '',$aNit))
			->select('activo','usuarioid')
			->first();
	}
}
