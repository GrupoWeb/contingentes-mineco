<?php

class Movimiento extends Eloquent {
	protected $primryKey = 'movimientoid';
	
	/*--- tabla tipomovimientoids de movimiento 
	| 1 - cuota
	| 2 - certificado
	| 3 - asignacion
	| 4 - penalizacion	
	*/

	public static function getCuentaCorriente($aPeriodoId) {
		return DB::table('movimientos AS m')
			->select(DB::raw('DATE_FORMAT(m.created_at, "%d-%m-%Y") AS fecha'), 'u.nombre AS acreditadoa', 
				'u2.nombre AS acreditadopor', 'comentario','certificadoid', 
				DB::raw('IF(m.tipomovimientoid = 1, cantidad, NULL) AS credito'),
				DB::raw('IF(m.tipomovimientoid <> 1, IF(m.tipomovimientoid = 3, cantidad, -cantidad), NULL) AS debito')
				)
			->leftJoin('authusuarios AS u', 'm.usuarioid',  '=', 'u.usuarioid')
			->leftJoin('authusuarios AS u2', 'm.created_by', '=', 'u2.usuarioid')
			->leftJoin('periodos AS p','m.periodoid','=','p.periodoid')
			->leftJoin('contingentes AS c','p.contingenteid','=','c.contingenteid')
			->orderBy('m.created_at')
			->orderBy('m.movimientoid')
			->where('m.periodoid', $aPeriodoId)
			->whereRaw('IF(c.tipotratadoid=1,m.tipomovimientoid IN (1,2), m.tipomovimientoid IN(3,1,4) )')
			->get();
	}

	public static function getCuentaCorrienteEmpresa($aPeriodoId, $aEmpresaId) {
		$query = DB::table('movimientos AS m')
			->select(DB::raw('DATE_FORMAT(m.created_at, "%d-%m-%Y") AS fecha'), 'u.nombre AS acreditadoa', 
				'u2.nombre AS acreditadopor', 'comentario','certificadoid', 
				DB::raw('IF(m.tipomovimientoid = 3, cantidad, NULL) AS credito'),
				DB::raw('IF(m.tipomovimientoid = 2, cantidad, NULL) AS debito'))
			->leftJoin('authusuarios AS u', 'm.usuarioid',  '=', 'u.usuarioid')
			->leftJoin('authusuarios AS u2', 'm.created_by', '=', 'u2.usuarioid')
			->leftJoin('empresas AS e', 'u.empresaid', '=', 'e.empresaid')
			->orderBy('u.nombre')
			->orderBy('m.usuarioid')
			->orderBy('m.created_at')
			->orderBy('m.movimientoid')
			->where('m.periodoid', $aPeriodoId)
			->whereIn('m.tipomovimientoid', array(3, 2));

			if($aEmpresaId <> 0)
				$query->where('e.empresaid', $aEmpresaId);

			return $query->get();
	}

	public static function getSaldo($aUsuarioId, $aContingenteId) {
		return DB::table('movimientos AS m')
			->select(DB::raw('SUM(cantidad) AS total, getSaldo(p.contingenteid, m.usuarioid) AS disponible'))
			->leftJoin('periodos AS p','m.periodoid','=','p.periodoid')
			->leftJoin('contingentes AS c','p.contingenteid','=','c.contingenteid')
			->leftJoin('tipomovimientoidtratados AS tt','c.tipomovimientoidtratadoid','=','tt.tipomovimientoidtratadoid')
			->whereRaw('NOW() BETWEEN p.fechainicio AND p.fechafin')
			->whereRaw('(if(tt.`asignacion`=1, m.tipomovimientoid IN(3), m.tipomovimientoid IN(1)))')
			->where('p.contingenteid', $aContingenteId)
			->where('m.usuarioid', $aUsuarioId)
			->first();
	}

	public static function getMovimientos($aContingenteId, $aEmpresaId, $atipomovimientoid) { 
		return DB::table('movimientos AS m')
			->selectRaw('IFNULL(ABS(SUM(cantidad)), 0) AS cantidad')
			->leftJoin('periodos AS p', 'm.periodoid', '=', 'p.periodoid')
			->leftJoin('contingentes AS c', 'p.contingenteid', '=', 'c.contingenteid')
			->where('tipomovimientoid', $atipomovimientoid)
			->where('c.contingenteid', $aContingenteId)
			->whereIn('usuarioid', Usuario::listUsuariosEmpresa($aEmpresaId))
			->first();
	}

	public static function getToneladasUsuario($aUsuarioId) {
		$tipoemision = DB::table('tiposmovimiento')->where('nombre', 'Certificado')->pluck('tipomovimientoid');

		return DB::table('movimientos')
			->where('usuarioid', $aUsuarioId)
			->where('tipomovimientoid', $tipoemision)
			->whereNotNull('certificadoid')
			->sum('cantidad');
	}

	public static function getUtilizaciones($aContingenteid, $aEmpresaid, $aFechainicio, $aFechafin) {
		$query = DB::table('movimientos AS m')
			->select('e.nit AS nit', 'e.razonsocial', 'c.numerocertificado', 'c.fraccion',
				'c.dua', 'c.real', 'c.cif', 'c.variacion','u.usuarioid',
				DB::raw('DATE_FORMAT(m.created_at, "%d/%m/%y") AS fecha'),
				DB::raw('DATE_FORMAT(c.fechavencimiento, "%d/%m/%y") AS fechavencimiento'),
				DB::raw('DATE_FORMAT(c.fechaliquidacion, "%d/%m/%y") AS fechaliquidacion'),
				DB::raw('(SELECT SUM(m2.cantidad) FROM movimientos m2
					LEFT JOIN authusuarios AS u2 ON m2.usuarioid=u2.usuarioid
					LEFT JOIN empresas AS e2 ON e2.empresaid=u2.empresaid 
					WHERE m2.periodoid=m.periodoid AND m2.tipomovimientoid IN(3,4) AND e2.empresaid=e.empresaid) AS asignado'),
				DB::raw('(SELECT SUM(m2.cantidad) FROM movimientos m2 
					WHERE m2.periodoid=m.periodoid AND m2.tipomovimientoid=1) AS volumentotal'),
				DB::raw('ABS(cantidad) AS cantidad'))
			->leftJoin('authusuarios AS u', 'm.usuarioid', '=', 'u.usuarioid')
			->leftJoin('empresas AS e', 'u.empresaid', '=', 'e.empresaid')
			->leftJoin('certificados AS c', 'm.certificadoid', '=', 'c.certificadoid')
			->leftJoin('periodos AS p', 'm.periodoid', '=', 'p.periodoid')
			->leftJoin('contingentes AS cn', 'p.contingenteid', '=', 'cn.contingenteid')
			->where('tipomovimientoid', 2)
			->where('cn.contingenteid', $aContingenteid);

		if($aEmpresaid <> 0)
			$query->where('u.empresaid', $aEmpresaid);

		if($aFechainicio <> '' && $aFechafin <> '')
			$query->whereBetween('m.created_at', array($aFechainicio, $aFechafin));
			
		$query->orderBy('e.razonsocial');
		$query->orderBy('m.created_at');

		return $query->get();
	}
} 






