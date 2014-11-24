<?php

class Productorequerimiento extends Eloquent {

	protected $primaryKey = 'priid';

	public static function getRequerimientos($aProducto, $aTipo){
		return DB::table('productorequerimientos AS pr')
			->select('priid', 'nombre','pr.requerimientoid As requerimientoid')
			->leftJoin('requerimientos AS r', 'pr.requerimientoid', '=', 'r.requerimientoid')
			->where('productoid', $aProducto)
			->where('tipo', $aTipo)
			->orderBy('priid')
			->get();
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