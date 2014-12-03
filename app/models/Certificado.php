<?php

class Certificado extends Eloquent {

	protected $primryKey = 'certificadoid';

	public static function getCertificado($aId) {
		return DB::table('certificados AS c')
			->leftJoin('authusuarios AS u','c.usuarioid','=','u.usuarioid')
			->select('c.certificadoid','c.tratado','c.tratadodescripcion', 'c.nombre',
				'c.direccion','c.nit','c.telefono',
				'c.volumen','c.volumenletras','c.fraccion','c.paisprocedencia',
				DB::raw('DATE_FORMAT(c.fecha,"%d-%m-%Y") AS fecha'),
				DB::raw('DATE_FORMAT(c.fechavencimiento,"%d-%m-%Y") AS fechavencimiento'), 
				'u.nombrecompleto','u.puesto','u.firma','u.certificado')
			->where('c.certificadoid', $aId)
			->first();
	}
}