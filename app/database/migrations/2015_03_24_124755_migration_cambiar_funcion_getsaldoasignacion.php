<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationCambiarFuncionGetsaldoasignacion extends Migration {

	public function up() {
		DB::unprepared('DROP FUNCTION IF EXISTS getSaldoAsignacion');
		DB::unprepared("CREATE FUNCTION getSaldoAsignacion(aContingenteId INTEGER, aUsuarioId INTEGER) RETURNS DECIMAL(20,5)
			BEGIN
			  RETURN (SELECT 
			    IFNULL(SUM(IF(m.tipomovimientoid = 3, -1, 1)*cantidad), 0) AS saldo 
			  FROM movimientos AS m
			  LEFT JOIN periodos AS p USING(periodoid)
			  LEFT JOIN contingentes AS c USING(contingenteid)
			  LEFT JOIN tratados AS t USING(tratadoid)
			  LEFT JOIN tipotratados AS tt USING(tipotratadoid)
			  WHERE p.contingenteid = aContingenteId
			  AND m.tipomovimientoid IN(1, 3));
			END");
	}

	public function down() {
		DB::unprepared('DROP FUNCTION IF EXISTS getSaldoAsignacion');
		DB::unprepared("CREATE FUNCTION getSaldoAsignacion(aContingenteId INTEGER, aUsuarioId INTEGER) RETURNS DECIMAL(20,5)
			BEGIN
			  RETURN (SELECT 
			    IFNULL(SUM(IF(m.tipo='Asignacion',-1,1)*cantidad), 0) AS saldo 
			  FROM movimientos AS m
			  LEFT JOIN periodos AS p USING(periodoid)
			  LEFT JOIN contingentes AS c USING(contingenteid)
			  LEFT JOIN tratados AS t USING(tratadoid)
			  LEFT JOIN tipotratados AS tt USING(tipotratadoid)
			  WHERE p.contingenteid = aContingenteId
			  AND m.tipo IN('Cuota','Asignacion'));
			END");
	}

}
