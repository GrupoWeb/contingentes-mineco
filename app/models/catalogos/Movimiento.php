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
				DB::raw('IF( (m.tipomovimientoid=3) or (m.tipomovimientoid=2 and cantidad>0), cantidad, NULL) AS credito'),
				DB::raw('IF( (m.tipomovimientoid=2 and cantidad<0), (cantidad*-1), NULL) AS debito'))
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

	public static function getSaldo($aEmpresaId, $aContingenteId) {
		return DB::table('movimientos AS m')
			->select(DB::raw('SUM(cantidad) AS total, getSaldo(p.contingenteid, m.usuarioid) AS disponible'))
			->leftJoin('periodos AS p','m.periodoid','=','p.periodoid')
			->leftJoin('contingentes AS c','p.contingenteid','=','c.contingenteid')
			->leftJoin('tipomovimientoidtratados AS tt','c.tipomovimientoidtratadoid','=','tt.tipomovimientoidtratadoid')
			->leftJoin('authusuarios AS u','u.usuarioid','m.usuarioid')
			->whereRaw('NOW() BETWEEN p.fechainicio AND p.fechafin')
			->whereRaw('(if(tt.`asignacion`=1, m.tipomovimientoid IN(3), m.tipomovimientoid IN(1)))')
			->where('p.contingenteid', $aContingenteId)
			->where('u.empresaid', $aEmpresaId)
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

	public static function getCuantosCertificadosEmpresa($aEmpresaId) {
		return DB::table('movimientos AS m')
			->leftJoin('authusuarios AS u','m.usuarioid','=','u.usuarioid')
			->leftJoin('tiposmovimiento AS t', 'm.tipomovimientoid','=','t.tipomovimientoid')
			->where('u.empresaid', $aEmpresaId)
			->where('t.nombre', 'Certificado')
			->count();
	}

	public static function getUtilizaciones($aContingenteid, $aEmpresaid, $aFechainicio, $aFechafin) {
		$query = DB::table('authusuarios AS u')
			->select('e.nit AS nit', 'e.razonsocial', 'c.numerocertificado', 'c.fraccion',
				'c.dua', 'c.real', 'c.cif', 'c.variacion','u.usuarioid', 'm.tipomovimientoid',
				DB::raw('DATE_FORMAT(m.created_at, "%d/%m/%y") AS fecha'),
				DB::raw('DATE_FORMAT(c.fechavencimiento, "%d/%m/%y") AS fechavencimiento'),
				DB::raw('DATE_FORMAT(c.fechaliquidacion, "%d/%m/%y") AS fechaliquidacion'),
				DB::raw('(SELECT SUM(m2.cantidad) FROM movimientos m2
					LEFT JOIN authusuarios AS u2 ON m2.usuarioid=u2.usuarioid
					LEFT JOIN empresas AS e2 ON e2.empresaid=u2.empresaid 
					WHERE m2.periodoid=m.periodoid AND m2.tipomovimientoid IN(3,4) AND e2.empresaid=e.empresaid) AS asignado'),
				DB::raw('(SELECT SUM(m2.cantidad) FROM movimientos m2 
					WHERE m2.periodoid=m.periodoid AND m2.tipomovimientoid=1) AS volumentotal'),
				DB::raw('(m.cantidad*-1) AS cantidad'))
			->leftJoin('empresas AS e', 'e.empresaid', '=', 'u.empresaid')
			->leftJoin('movimientos AS m', 'u.usuarioid', '=', 'm.usuarioid')
			->leftJoin('certificados AS c', 'm.certificadoid', '=', 'c.certificadoid')
			->leftJoin('periodos AS p', 'm.periodoid', '=', 'p.periodoid')
			->leftJoin('contingentes AS cn', 'p.contingenteid', '=', 'cn.contingenteid')
			->whereIn('m.tipomovimientoid', array(2,3))
			->where('cn.contingenteid', $aContingenteid);

		if($aEmpresaid <> 0)
			$query->where('u.empresaid', $aEmpresaid);

		if($aFechainicio <> '' && $aFechafin <> '')
			$query->whereBetween('m.created_at', array($aFechainicio, $aFechafin));
			
		$query->orderBy('e.razonsocial');
		$query->orderBy('m.tipomovimientoid');
		$query->orderBy('m.created_at');

		return $query->get();
	}

	public static function getConsolidadoUtilizacion($aInicio, $aFin) {
		$activado = DB::table('tiposmovimiento')->where('nombre', 'Cuota')->pluck('tipomovimientoid');
		$asignado = DB::table('tiposmovimiento')->where('nombre', 'Asignación')->pluck('tipomovimientoid');
		$emitido  = DB::table('tiposmovimiento')->where('nombre', 'Certificado')->pluck('tipomovimientoid');

		return DB::table('periodos AS p')
			->select('p.contingenteid', 't.nombrecorto', 'pr.nombre',
				DB::raw("(SELECT IFNULL(SUM(cantidad), 0) FROM movimientos AS m WHERE m.tipomovimientoid = $activado AND m.periodoid = p.periodoid) AS activado"),
				DB::raw("(SELECT IFNULL(ABS(SUM(cantidad)), 0) FROM movimientos AS m WHERE m.tipomovimientoid = $asignado AND m.periodoid = p.periodoid AND m.created_at BETWEEN '".$aInicio."' AND '".$aFin."') AS asignado"),
				DB::raw("(SELECT IFNULL(ABS(SUM(cantidad)), 0) FROM movimientos AS m WHERE m.tipomovimientoid = $emitido AND m.periodoid = p.periodoid AND m.created_at BETWEEN '".$aInicio."' AND '".$aFin."') AS emitido"))
			->leftJoin('contingentes AS c', 'p.contingenteid', '=', 'c.contingenteid')
			->leftJoin('productos AS pr', 'c.productoid', '=', 'pr.productoid')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->whereRaw('NOW() between fechainicio AND fechafin')
			->orderBy('t.nombrecorto')
			->orderBy('pr.nombre')
			->get();
	}


	public static function getUtilizacionEmpresas($aPeriodoId, $aEmpresaId=0) {
		$aEmpresaId = (int)$aEmpresaId;
		$query = DB::table('empresacontingentes AS ec')
			->leftJoin('empresas AS e','ec.empresaid','=','e.empresaid')
			->select('e.razonsocial','e.empresaid',
				DB::raw('(SELECT getConsumoPeriodo(' . $aPeriodoId . ',e.empresaid)) AS consumo'),
				DB::raw('(SELECT getTotalPeriodo(' . $aPeriodoId . ',e.empresaid)) AS totalperiodo'),
				DB::raw('(SELECT getLiquidadoPeriodo(' . $aPeriodoId . ',e.empresaid)) AS liquidado'),
				DB::raw('(SELECT getAsignacionPeriodo(' . $aPeriodoId . ',e.empresaid)) AS asignado')
				)
			->orderBy('e.razonsocial')
			->orderBy('e.empresaid')
			->groupBy('e.razonsocial')
			->groupBy('e.empresaid');

		if($aEmpresaId<>0)
			$query->where('e.empresaid', $aEmpresaId);
		else
			$query->whereRaw('ec.contingenteid=(SELECT c.contingenteid 
					FROM periodos AS p
					LEFT JOIN contingentes AS c ON p.contingenteid=c.contingenteid
					WHERE p.periodoid=' . $aPeriodoId . ')');
		return $query->get();
	}

	public static function getConsumoYSaldo($aPeriodoId, $aEmpresaId) {
		return DB::table('tipotratados')
		    ->select(
					DB::raw('(SELECT getTotalPeriodo(' . $aPeriodoId . ',' . $aEmpresaId . ')) AS total'),
					DB::raw('(SELECT getConsumoPeriodo(' . $aPeriodoId . ',' . $aEmpresaId . ')) AS consumo'),
					DB::raw('(SELECT getConsumoPeriodo(' . $aPeriodoId . ',0)) AS consumototal'),
					DB::raw('(SELECT getAsignacionPeriodo(' . $aPeriodoId . ',' . $aEmpresaId . ')) AS asignado')
				)
				->first();
	}

	public static function getConsumoYSaldoActual($aContingenteId, $aEmpresaId) {

		$periodoid = Periodo::getPeriodo($aContingenteId);
		return self::getConsumoYSaldo($periodoid, $aEmpresaId);
	}
} 
