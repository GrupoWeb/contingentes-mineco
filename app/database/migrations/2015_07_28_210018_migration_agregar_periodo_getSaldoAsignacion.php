<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationAgregarPeriodoGetSaldoAsignacion extends Migration {

	public function up() {
		DB::unprepared('DROP FUNCTION IF EXISTS getSaldoAsignacion');
		DB::unprepared("CREATE FUNCTION getSaldoAsignacion(aContingenteId INTEGER, aUsuarioId INTEGER) RETURNS DECIMAL(20,5)
			BEGIN
			  RETURN (SELECT 
			    IFNULL(SUM(IF(m.tipomovimientoid = 3, -1, 1)*cantidad), 0) AS saldo 
			  FROM movimientos AS m
			  LEFT JOIN periodos AS p USING(periodoid)
			  WHERE p.contingenteid = aContingenteId
			  AND NOW() BETWEEN p.fechainicio AND p.fechafin
			  AND m.tipomovimientoid IN(1, 3));
			END");

		DB::unprepared('DROP FUNCTION IF EXISTS getSaldoAsignacionPeriodo');
		DB::unprepared("CREATE FUNCTION getSaldoAsignacionPeriodo(aPeriodoId INTEGER) RETURNS DECIMAL(20,5)
			BEGIN
			  RETURN (SELECT 
			    IFNULL(SUM(IF(tipomovimientoid = 3, -1, 1)*cantidad), 0) AS saldo 
			  FROM movimientos
			  WHERE periodoid = aPeriodoId
			  AND tipomovimientoid IN(1, 3));
			END");
	}

	public function down() {
		$this->up();
	}

}
