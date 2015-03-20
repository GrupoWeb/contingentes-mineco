<?php

class Empresarequerimiento extends Eloquent {

	protected $primaryKey = 'empresarequerimientoid';
	protected $table      = 'empresarequerimientos';

	public static function getEmpresaRequerimientos($aEmpresaId){
		return DB::table('empresarequerimientos AS ur')
			->select('ur.archivo','r.nombre', 'ur.empresaid','r.requerimientoid')
			->leftJoin('requerimientos As r','r.requerimientoid','=','ur.requerimientoid')
			->where('ur.empresaid',$aEmpresaId)
			->get();
	}	

	public static function getEmpresaRequerimientosIds() {
		return DB::table('empresarequerimientos')
			->where('empresaid', Auth::user()->empresaid)
			->lists('requerimientoid');
	}
}