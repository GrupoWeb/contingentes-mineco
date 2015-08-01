<?php

class Empresa extends Eloquent {

	protected $primaryKey = 'empresaid';

	public static function getEmpresas($contingenteid, $fechaini, $fechafin) {
		return DB::table('empresas AS e')
			->select(DB::raw('DATE_FORMAT(e.created_at, "%d-%m-%Y") AS fecha'),'ec.contingenteid', 'p.nombre AS producto', 
				'e.razonsocial AS nombre','t.nombrecorto AS tratado')
			->leftJoin('empresacontingentes AS ec', 'ec.empresaid', '=', 'e.empresaid')
  		->leftJoin('contingentes AS c', 'c.contingenteid', '=', 'ec.contingenteid')
  		->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->where('ec.contingenteid', $contingenteid)
     	->whereBetween('e.created_at', array($fechaini, $fechafin))
			->get();
	}

	public static function getActivaNit($aNit) {
		return DB::table('authusuarios u')
			->leftJoin('empresas AS e','u.empresaid','=','e.empresaid')
			->whereIn('u.rolid', Config::get('contingentes.rolempresa') )
			->where( DB::raw('REPLACE(e.nit,"-","")'), str_replace('-', '',$aNit))
			->select('u.activo','u.empresaid')
			->first();
	}

	public static function getEmpresasPeriodo($aPeriodoid, $aEmpresaId) {
		$query = DB::table('empresas AS e')
			->select('e.empresaid', 'e.razonsocial AS nombre')
			->leftJoin('empresacontingentes AS ec', 'e.empresaid', '=', 'ec.empresaid')
			->leftJoin('periodos AS p', 'ec.contingenteid', '=', 'p.contingenteid')
			->where('p.periodoid', $aPeriodoid);

		if($aEmpresaId)
			$query->where('e.empresaid', $aEmpresaId);

		return	$query->get();
	}
}