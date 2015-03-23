<?php

class Contingente extends Eloquent {

	protected $primaryKey = 'contingenteid';
	protected $guarded    = array('contingenteid');

	public static function getContingentes($filter=null) {
		$query =  DB::table('contingentes AS c')
			->select('contingenteid','t.nombrecorto AS tratado','p.nombre AS producto', 't.tipo')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->orderBy('t.tipo','DESC')
			->orderBy('t.nombre')
			->orderBy('p.nombre');
        if(count($filter))
          $query->whereNotIn('c.contingenteid',$filter); 
        return $query->get();
	}

	public static function getContingentesCuota() {
		return DB::table('contingentes AS c')
			->select('contingenteid','t.nombrecorto AS tratado','p.nombre AS producto', 't.tipo')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('tipotratados AS tt','c.tipotratadoid','=','tt.tipotratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->where('tt.asignacion',1)
			->orderBy('t.tipo','DESC')
			->orderBy('t.nombre')
			->orderBy('p.nombre')
			->get();
	}

	public static function getContTratado($aTratadoId) {
		return DB::table('contingentes AS c')
			->select('contingenteid', 'p.nombre AS producto')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->where('c.tratadoid', $aTratadoId)
			->orderBy('p.nombre')
			->get();
	}

	public static function getUnidadMedida($aContingenteId) {
		return DB::table('contingentes AS c')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->leftJoin('unidadesmedida AS u', 'p.unidadmedidaid', '=', 'u.unidadmedidaid')
			->pluck('u.nombrecorto');
	}

	public static function getNombre($aContingenteId) {
		return DB::table('contingentes AS c')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->selectRaw('CONCAT(t.nombrecorto, " - ", p.nombre) AS nombre')
			->where('c.contingenteid', $aContingenteId)
			->first();
	}

	public static function getContingentesTratado($aTratadoId) {
		return DB::table('contingentes')
			->where('tratadoid', $aTratadoId)
			->lists('contingenteid');
	}

	public static function getProducto($aContingenteId) {
		return DB::table('contingentes AS c')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->where('contingenteid', $aContingenteId)
			->pluck('p.nombre');
	}

	public static function getPais($aContingenteId) {
		return DB::table('contingentes AS c')
			->select('p.paisid', 'p.nombre')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('paises AS p', 't.paisid', '=', 'p.paisid')
			->where('c.contingenteid', $aContingenteId)
			->first();
	}

	public static function getTipoTratado($aContingneteId) {
		return DB::table('contingentes AS c')
			->leftJoin('tipotratados AS t', 'c.tipotratadoid', '=', 't.tipotratadoid')
			->where('contingenteid', $aContingneteId)
			->pluck('asignacion');
	}
}
