<?php

class Contingenterequerimiento extends Eloquent {

	protected $primaryKey = 'priid';


	public static function getRequerimientos($aProducto,$aTipo=null){
		$query = DB::table('contingenterequerimientos AS pr')
			->select('r.nombre','r.contingenterequerimientoid')
			->leftJoin('requerimientos AS r', 'pr.contingenterequerimientoid', '=', 'r.contingenterequerimientoid')
			->whereIn('contingenterequerimientoid', explode(',',$aProducto))
			->groupBy('r.contingenterequerimientoid');
			
			if($aTipo)
				$query->where('tipo', $aTipo);
			
			$query->orderBy('priid');
			return $query->get();
	}

	public static function getcontingenterequerimientos() {
		return DB::table('contingenterequerimientos')
			->select('*')
			->orderBy('priid')
			->get();
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