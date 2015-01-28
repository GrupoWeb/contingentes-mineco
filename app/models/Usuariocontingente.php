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
			->where('uc.usuarioid',$aID)
			->get();
	}
}
