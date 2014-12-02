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
}
