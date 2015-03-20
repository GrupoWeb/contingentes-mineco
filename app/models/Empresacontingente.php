<?php

class Empresacontingente extends Eloquent {

	protected $primaryKey = 'empresacontingenteid';

	public static function getContingentes($asignacion=false) {
		$query = DB::table('empresacontingentes AS uc')
			->select('uc.contingenteid', 't.nombrecorto AS tratado', 'p.nombre AS producto', 'c.tratadoid','t.tipo')
			->leftJoin('contingentes AS c', 'uc.contingenteid', '=', 'c.contingenteid')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->where('uc.empresaid', Auth::user()->empresaid);

		if($asignacion) {
			$query->leftJoin('tipotratados AS tt', 'c.tipotratadoid', '=', 'tt.tipotratadoid');
			$query->where('tt.asignacion', 1);
		}
		return $query->get();
	}
	
  public static function contingentesEmpresa($aEmpresaId) {
	  return DB::table('empresacontingentes AS uc')
			->select('uc.contingenteid', 't.nombrecorto AS tratado', 'p.nombre AS producto', 'c.tratadoid')
			->leftJoin('contingentes AS c', 'uc.contingenteid', '=', 'c.contingenteid')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->where('uc.empresaid',$aEmpresaId)
			->get();
	}

	public static function contingentesEmpresaTratado($aEmpresaId, $aTratadoId) {
		$res = DB::table('empresacontingentes AS uc')
			->select('uc.contingenteid', 'p.nombre AS producto', DB::raw('getSaldo(uc.contingenteid, uc.empresaid) AS saldo') )
			->leftJoin('contingentes AS c', 'uc.contingenteid', '=', 'c.contingenteid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->where('uc.empresaid',$aEmpresaId)
			->where('c.tratadoid', $aTratadoId);
		return $res->get();
	}

	public static function getTratadosEmpresa($aEmpresaId) {
		return DB::table('empresacontingentes AS uc')
			->select('t.tratadoid','t.nombrecorto AS nombre')
			->leftJoin('contingentes AS c', 'uc.contingenteid','=','c.contingenteid')
			->leftJoin('tratados AS t','c.tratadoid','=','t.tratadoid')
			->groupBy('c.tratadoid')
			->where('uc.empresaid', $aEmpresaId)
			->get();
	}

	public static function getEmpresasContingente($aContingenteId) {
		return DB::table('empresacontingentes AS ec')
			->select('e.empresaid', 'e.nombre')
			->leftJoin('empresas AS e', 'ec.empresaid', '=', 'e.empresaid')
			->where('ec.contingenteid', $aContingenteId)
			->get();
	}
}
