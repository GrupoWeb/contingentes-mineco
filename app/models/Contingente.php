<?php

class Contingente extends Eloquent {

	protected $primryKey = 'contingenteid';

	public static function getContingentes() {
		return DB::table('contingentes AS c')
			->select('contingenteid','t.nombre AS tratado','p.nombre AS producto')
			->leftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid')
			->leftJoin('productos AS p', 'c.productoid', '=', 'p.productoid')
			->orderBy('t.nombre')
			->orderBy('p.nombre')
			->get();
	}
}
