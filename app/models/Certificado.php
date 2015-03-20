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
			->select('c.certificadoid','c.anulado','c.tratado','c.tratadodescripcion', 'c.nombre',
				'c.direccion','c.nit','c.telefono', 'pc.vista',
				'c.volumen','c.volumenletras','c.fraccion','p.nombre as paisprocedencia',
				DB::raw('DATE_FORMAT(c.fecha,"%d-%m-%Y") AS fecha'),
				DB::raw('DATE_FORMAT(c.fechavencimiento,"%d-%m-%Y") AS fechavencimiento'), 
				'u.nombrecompleto','u.puesto','u.firma','u.certificado')
			->where('c.certificadoid', $aId)
			->first();
	}
}