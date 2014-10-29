<?php

class Productorequerimiento extends Eloquent {

	protected $primryKey = 'priid';

	public static function getRequerimientos($aProducto,$aTipo=null){
		$query = DB::table('productorequerimientos AS pr')
			->select('priid', 'nombre','pr.requerimientoid As requerimientoid')
			->leftJoin('requerimientos AS r', 'pr.requerimientoid', '=', 'r.requerimientoid')
			->where('productoid', $aProducto);
			
			if($aTipo)
				$query->where('tipo', $aTipo);
			
			$query->orderBy('priid');
			return $query->get();
	}

	public static function getProductoRequerimientos() {
		return DB::table('productorequerimientos')
			->select('*')
			->orderBy('priid')
			->get();
	}

	public static function getRequerimientosAsignados($id){
		return DB::table('productorequerimientos')
			->select('*')
			->where('productoid','=',$id)
			->where('tipo','=' , 'Asignación')
			->get();
	}

	public static function getRequerimientosEmision($id){
		return DB::table('productorequerimientos')
			->select('*')
			->where('productoid','=',$id)
			->where('tipo','=' , 'Emisión')
			->get();
	}

		public static function getRequerimientosInscripcion($id){
		return DB::table('productorequerimientos')
			->select('*')
			->where('productoid','=',$id)
			->where('tipo','=' , 'Inscripción')
			->get();
	}

}