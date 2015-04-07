<?php

class Contingenterequerimiento extends Eloquent {
	protected $primryKey = 'contingenterequerimientoid';

	public static function getRequerimientos($aContingenteId, $aTipo=null,$aReq=null){
		$query = DB::table('contingenterequerimientos AS cr')
			->select('r.nombre','r.requerimientoid')
			->leftJoin('requerimientos AS r', 'cr.requerimientoid', '=', 'r.requerimientoid')
			->where('contingenteid', $aContingenteId)
			->groupBy('r.requerimientoid');
			
			if($aTipo)
				$query->where('tipo', $aTipo);
      
      if(count($aReq))
				$query->whereNotIn('r.requerimientoid',$aReq);
			
			$query->orderBy('contingenterequerimientoid');
			return $query->get();
	}

	public static function getRequerimientosAsignados($id){
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
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->where('contingenteid','=',$id)
			->pluck('p.nombre');
	}
}
