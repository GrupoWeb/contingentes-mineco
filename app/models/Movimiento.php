<?php

class Movimiento extends Eloquent {
	protected $primryKey = 'movimientoid';

	public static function getCuentaCorriente($aPeriodoId) {
		return DB::table('movimientos AS m')
			->select(DB::raw('DATE_FORMAT(m.created_at, "%d-%m-%Y") AS fecha'), 'u.nombre AS acreditadoa', 
				'u2.nombre AS acreditadopor', 'comentario', 
				DB::raw('IF(m.tipo="Cuota",cantidad,NULL) AS credito'),
				DB::raw('IF(m.tipo<>"Cuota", IF(m.tipo="Asignación",cantidad,-cantidad),NULL) AS debito')
				)
			->leftJoin('authusuarios AS u', 'm.usuarioid',  '=', 'u.usuarioid')
			->leftJoin('authusuarios AS u2', 'm.created_by', '=', 'u2.usuarioid')
			->orderBy('m.created_at')
			->orderBy('m.movimientoid')
			->where('m.periodoid', $aPeriodoId)
			->whereIn('m.tipo', array('Asignación','Cuota'))
			->get();
	}

	public static function getCuentaCorrienteEmpresa($aPeriodoId, $aEmpresaId) {
		return DB::table('movimientos AS m')
			->select(DB::raw('DATE_FORMAT(m.created_at, "%d-%m-%Y") AS fecha'), 'u.nombre AS acreditadoa', 
				'u2.nombre AS acreditadopor', 'comentario', 
				DB::raw('IF(m.tipo="Asignación",cantidad,NULL) AS credito'),
				DB::raw('IF(m.tipo="Certificado",cantidad,NULL) AS debito')
				)
			->leftJoin('authusuarios AS u', 'm.usuarioid',  '=', 'u.usuarioid')
			->leftJoin('authusuarios AS u2', 'm.created_by', '=', 'u2.usuarioid')
			->orderBy('m.created_at')
			->orderBy('m.movimientoid')
			->where('m.periodoid', $aPeriodoId)
			->whereIn('m.tipo', array('Asignación','Certificado'))
			->get();
	}

	public static function getSaldo($aUsuarioId, $aContingenteId) {
		return DB::table('movimientos AS m')
			->select(DB::raw('SUM(cantidad) AS total, getSaldo(p.contingenteid, m.usuarioid) AS disponible'))
			->leftJoin('periodos AS p','m.periodoid','=','p.periodoid')
			->leftJoin('contingentes AS c','p.contingenteid','=','c.contingenteid')
			->leftJoin('tipotratados AS tt','c.tipotratadoid','=','tt.tipotratadoid')
			->whereRaw('NOW() BETWEEN p.fechainicio AND p.fechafin')
			->whereRaw('(if(tt.`asignacion`=1, m.tipo IN("Asignacion"), m.tipo IN("Cuota")))')
			->where('p.contingenteid', $aContingenteId)
			->where('m.usuarioid', $aUsuarioId)
			->first();
	}

	public static function getMovimientos($aContingenteId, $aEmpresaId, $aTipo) { 
		return DB::table('movimientos AS m')
			->selectRaw('IFNULL(ABS(SUM(cantidad)), 0) AS cantidad')
			->leftJoin('periodos AS p', 'm.periodoid', '=', 'p.periodoid')
			->leftJoin('contingentes AS c', 'p.contingenteid', '=', 'c.contingenteid')
			->where('tipo', $aTipo)
			->where('c.contingenteid', $aContingenteId)
			->whereIn('usuarioid', Usuario::listUsuariosEmpresa($aEmpresaId))
			->first();
	}
}