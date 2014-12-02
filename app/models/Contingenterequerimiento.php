<?php

class Contingenterequerimiento extends Eloquent {
	protected $primryKey = 'contingenterequerimientoid';

	public static function getRequerimientos($aContingenteId, $aTipo=null){
		$query = DB::table('contingenterequerimientos AS cr')
			->select('r.nombre','r.requerimientoid')
			->leftJoin('requerimientos AS r', 'cr.requerimientoid', '=', 'r.requerimientoid')
			->whereIn('contingenteid', explode(',',$aContingenteId))
			->groupBy('r.requerimientoid');
			
			if($aTipo)
				$query->where('tipo', $aTipo);
			
			$query->orderBy('contingenterequerimientoid');
			return $query->get();
	}

	public static function getRequerimientosAsignados($id){
		//dd($id);
		return DB::table('contingenterequerimientos')
			->select('*')
			->where('contingenteid','=',$id)
			->where('tipo', '=' , 'asignacion')
			->get();
	}

	public static function getRequerimientosEmision($id){
		return DB::table('contingenterequerimientos')
			->select('*')
			->where('contingenteid','=',$id)
			->where('tipo','=' , 'Emisión')
			->get();
	}

		public static function getRequerimientosInscripcion($id){
		return DB::table('contingenterequerimientos')
			->select('*')
			->where('contingenteid','=',$id)
			->where('tipo','=' , 'Inscripción')
			->get();
	}

	public static function getNombre($id){
		return DB::table('contingentes AS c')
			->select(DB::raw('CONCAT(p.nombre,"-",t.nombre) AS nombre'))
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->where('contingenteid','=',$id)
			->get();
	}
}
