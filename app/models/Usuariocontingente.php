<?php

class Usuariocontingente extends Eloquent {

	protected $primaryKey = 'usuariocontingenteid';

	public static function getContingentes($asignacion=false) {
		return DB::table('usuariocontingentes AS uc')
			->select('uc.contingenteid', 't.nombrecorto AS tratado', 'p.nombre AS producto', 'c.tratadoid','t.tipo')
			->leftJoin('contingentes AS c', 'uc.contingenteid', '=', 'c.contingenteid')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->where('uc.usuarioid', Auth::id())
			->get();
	}
	
  public static function contingentesUsuario($aID) {
	  return DB::table('usuariocontingentes AS uc')
			->select('uc.contingenteid', 't.nombrecorto AS tratado', 'p.nombre AS producto', 'c.tratadoid','uc.activo')
			->leftJoin('contingentes AS c', 'uc.contingenteid', '=', 'c.contingenteid')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->where('uc.usuarioid',$aUsuarioId)
			->get();
	}

	public static function contingentesUsuarioTratado($aUsuarioId, $aTratadoId) {
		$res = DB::table('usuariocontingentes AS uc')
			->select('uc.contingenteid', 'p.nombre AS producto', DB::raw('getSaldo(uc.contingenteid, uc.usuarioid) AS saldo') )
			->leftJoin('contingentes AS c', 'uc.contingenteid', '=', 'c.contingenteid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->where('uc.usuarioid',$aUsuarioId)
			->where('c.tratadoid', $aTratadoId);

		return $res->get();
	}

	public static function getTratadosUsuario($aID) {
		return DB::table('usuariocontingentes AS uc')
			->select('t.tratadoid','t.nombrecorto AS nombre')
			->leftJoin('contingentes AS c', 'uc.contingenteid','=','c.contingenteid')
			->leftJoin('tratados AS t','c.tratadoid','=','t.tratadoid')
			->groupBy('c.tratadoid')
			->where('uc.usuarioid', $aID)
			->get();
	}

	public static function getSolicitudes($aContingentes) {
		return DB::table('usuariocontingentes')
			->select(DB::raw('COUNT(*) as cuenta'), 'activo')
			->whereIn('contingenteid', $aContingentes)
			->groupBy('activo')
			->orderBy('activo')
			->get();
	}
}
