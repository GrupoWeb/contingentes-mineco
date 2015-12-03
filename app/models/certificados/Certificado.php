<?php

class Certificado extends Eloquent {

	protected $primaryKey = 'certificadoid';

	public static function getCertificado($aId) {
		return DB::table('certificados AS c')
			->leftJoin('movimientos AS m','c.certificadoid','=','m.certificadoid')
			->leftJoin('periodos AS pe', 'm.periodoid', '=', 'pe.periodoid')
			->leftJoin('contingentes AS co', 'pe.contingenteid', '=', 'co.contingenteid')
			->leftJoin('plantillascertificados AS pc', 'co.plantillaid', '=', 'pc.plantillaid')
			->leftJoin('authusuarios AS u','m.created_by','=','u.usuarioid')
			->leftJoin('paises AS p','c.paisid','=','p.paisid')
			->leftJoin('unidadesmedida AS um','co.unidadmedidaid','=','um.unidadmedidaid')
			->select('c.certificadoid', 'c.numerocertificado','c.anulado','c.tratado','c.tratadodescripcion', 'c.nombre',
				'c.direccion','c.nit','c.telefono', 'pc.vista', 'c.variacion',
				'c.volumen','c.volumenletras','c.fraccion','p.nombre as paisprocedencia','um.nombre AS unidades', 'c.codigovupe',
				'c.producto',
				DB::raw('DATE_FORMAT(c.fecha,"%d-%m-%Y") AS fecha'),
				DB::raw('DATE_FORMAT(c.fechavencimiento,"%d-%m-%Y") AS fechavencimiento'), 
				DB::raw('DATE_FORMAT(c.fecha,"%Y-%m-%d") AS fechamy'),
				DB::raw('DATE_FORMAT(c.fechavencimiento,"%Y-%m-%d") AS fechavencimientomy'),
				'u.nombrecompleto','u.puesto','u.firma','u.certificado')
			->where('c.certificadoid', $aId)
			->first();
	}

	public static function getLiquidado($aCertificadoId) {
		return DB::table('certificados')
			->where('certificadoid', $aCertificadoId)
			->pluck('real');
	}

	public static function getCertificados($aTratadoId, $aContingenteId, $aPeridoId, $aEmpresaId, $aFechaInicio, $aFechaFin) {
		$query = DB::table('certificados AS c')
			->select('c.certificadoid','c.numerocertificado', 'c.fecha', 'c.nombre',
  			'c.volumen', 'c.anulado', 'm.comentario',
  			DB::raw("IF(c.fechaliquidacion IS NULL, 0, 1) AS liquidado"))
			->leftJoin('movimientos AS m', 'c.certificadoid', '=', 'm.certificadoid');

		if($aTratadoId <> -1 || $aContingenteId <> -1 || $aPeridoId <> -1) {
			$query->leftJoin('periodos AS p', 'm.periodoid', '=', 'p.periodoid')
				->leftJoin('contingentes AS co', 'p.contingenteid', '=', 'co.contingenteid')
				->leftJoin('tratados AS t', 'co.tratadoid', '=', 't.tratadoid');

			if($aTratadoId <> -1)
				$query->where('t.tratadoid', $aTratadoId);

			if($aContingenteId <> -1)
				$query->where('co.contingenteid', $aContingenteId);

			if($aPeridoId <> -1)
				$query->where('p.periodoid', $aPeridoId);
		}

		if($aEmpresaId <> -1) {
			$query->leftJoin('authusuarios AS u', 'c.usuarioid', '=', 'u.usuarioid')
				->leftJoin('empresas AS e', 'u.empresaid', '=', 'e.empresaid');

			$query->where('e.empresaid', $aEmpresaId);
		}

		$query->whereBetween('c.fecha', array($aFechaInicio, $aFechaFin));
		$query->orderBy('c.fecha', 'desc');
		return $query->get();
	}

	public static function getCertificadosPendientesUsuario($aUsuarioId) {
		$certificados = DB::table('solicitudesliquidacion')
			->where('usuarioid', $aUsuarioId)
			->where('estado', 'Pendiente')
			->lists('certificadoid');

		return DB::table('certificados')
			->select('certificadoid', 'numerocertificado')
			->where('usuarioid', $aUsuarioId)
			->whereNull('dua')
			->whereNotIn('certificadoid', $certificados)
			->get();
	}

	public static function getCertificadosPendientesSat() {
		return DB::table('certificados AS c')
			->select('c.*', 'u.nombre AS usuario', 'p.nombre AS pais')
			->leftJoin('authusuarios AS u', 'c.usuarioid', '=', 'u.usuarioid')
			->leftJoin('paises AS p', 'c.paisid', '=', 'p.paisid')
			->where('enviadosat', 0)
			->get();
	}

	public static function getEstadoCertificados() {
		return DB::table('certificados AS c')
			->select('certificadoid')
			->whereNotNull('fechaliquidacion')
			->where('anulado', 0)
			->get();
	}
}