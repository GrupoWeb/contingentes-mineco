<?php

class Contingente extends Eloquent {

	protected $primaryKey = 'contingenteid';
	protected $guarded    = array('contingenteid');


	public static function getTratado($aContingenteId){
		return DB::table('contingentes AS c')
			->select('t.tratadoid', 't.nombre', 't.nombrecorto', 't.tipo', 
				'c.tipotratadoid', 'tt.nombre AS tipotratado','tt.asignacion')
			->leftJoin('tratados AS t','c.tratadoid','=','t.tratadoid')
			->leftJoin('tipotratados AS tt','c.tipotratadoid','=','tt.tipotratadoid')
			->where('c.contingenteid','=', $aContingenteId)
			->first();
	}

	public static function getContingente($filter=null) {
		$query =  DB::table('contingentes AS c')
			->select('contingenteid','t.nombrecorto AS tratado','p.nombre AS producto', 't.tipo',
				DB::raw('IF(c.normativo IS NULL, t.normativo, c.normativo) AS normativopdf'))
			->where('contingenteid','=',$filter)
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->orderBy('t.tipo','DESC')
			->orderBy('t.nombre')
			->orderBy('p.nombre');

        

      return $query->get();
	}

	public static function getContingentes($filter=null) {
		$query =  DB::table('contingentes AS c')
			->select('contingenteid','t.nombrecorto AS tratado','p.nombre AS producto', 't.tipo',
				DB::raw('IF(c.normativo IS NULL, t.normativo, c.normativo) AS normativopdf'))
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

	public static function getContTratado($aTratadoId, $aExclude=null) {
		$query = DB::table('contingentes AS c')
			->select('c.contingenteid', 'p.nombre AS producto')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->leftJoin('periodos AS pe', 'c.contingenteid', '=', 'pe.contingenteid')
			->whereRaw('now() BETWEEN pe.fechainicio AND pe.fechafin')
			->where('c.tratadoid', $aTratadoId);

		if($aExclude)
			$query->whereNotIn('c.contingenteid', $aExclude);

		return $query->orderBy('p.nombre')->get();
	}

	public static function getContTratadoEmpresa($aTratadoId, $aEmpresaId) {
		$query = DB::table('contingentes AS c')
			->select('c.contingenteid', 'p.nombre AS producto')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->leftJoin('periodos AS pe', 'c.contingenteid', '=', 'pe.contingenteid')
			->whereRaw('now() BETWEEN pe.fechainicio AND pe.fechafin')
			->where('c.tratadoid', $aTratadoId)
			->whereRaw('c.contingenteid IN(SELECT ec.contingenteid FROM empresacontingentes ec WHERE ec.empresaid=' . (int)$aEmpresaId . ')');


		return $query->orderBy('p.nombre')->get();
	}

	public static function getUnidadMedida($aContingenteId) {
		return DB::table('contingentes AS c')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->leftJoin('unidadesmedida AS u', 'p.unidadmedidaid', '=', 'u.unidadmedidaid')
			->where('c.contingenteid', $aContingenteId)
			->pluck('u.nombrecorto');
	}

	public static function getNombre($aContingenteId) {
		return DB::table('contingentes AS c')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->leftJoin('authusuarios AS r','c.responsableid','=','r.usuarioid')
			->selectRaw('CONCAT(t.nombrecorto, " - ", p.nombre) AS nombre')
			->addSelect('r.nombre AS responsable','r.email AS responsableemail')
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

	public static function getProductos($aTratadoId) {
		$contingentes = DB::table('contingentes')
			->where('tratadoid', $aTratadoId)
			->lists('contingenteid');


		return DB::table('periodos AS p')
			->select('pr.nombre', 'c.normativo', 'u.nombrecorto',
				DB::raw("(SELECT 
						sum(cantidad)
					FROM movimientos AS m
					WHERE tipomovimientoid = ".DB::table('tiposmovimiento')->where('nombre', 'cuota')->pluck('tipomovimientoid')."
					AND m.periodoid = p.periodoid) AS activado"))
			->leftJoin('contingentes AS c', 'p.contingenteid', '=', 'c.contingenteid')
			->leftJoin('unidadesmedida AS u', 'c.unidadmedidaid', '=', 'u.unidadmedidaid')
			->leftJoin('productos AS pr', 'c.productoid', '=', 'pr.productoid')
			->whereRaw("NOW() BETWEEN fechainicio AND fechafin")
			->whereIn('p.contingenteid', $contingentes)
			->orderBy('pr.nombre')
			->get();
	}
}













