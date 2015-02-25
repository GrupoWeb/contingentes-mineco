<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationGetsaldo2 extends Migration {

	public function up() {
		DB::unprepared('DROP FUNCTION IF EXISTS getSaldo');
		DB::unprepared("CREATE FUNCTION getSaldo(aContingenteId INTEGER, aUsuarioId INTEGER) RETURNS DECIMAL(20,5)
										BEGIN
										  RETURN (SELECT 
										    IFNULL(SUM(cantidad), 0) AS saldo 
										  FROM movimientos AS m
										  LEFT JOIN periodos AS p USING(periodoid)
										  LEFT JOIN contingentes AS c USING(contingenteid)
										  LEFT JOIN tratados AS t USING(tratadoid)
										  LEFT JOIN tipotratados AS tt USING(tipotratadoid)
										  WHERE p.contingenteid = aContingenteId
										  AND IF(tt.asignacion = 1, (m.tipo IN('Asignacion','Certificado')), (m.tipo IN('Cuota','Certificado'))));
										END");
	}

	public function down() {
		DB::unprepared('DROP FUNCTION getSaldo');
		DB::unprepared("CREATE FUNCTION getSaldo(aContingenteId INTEGER, aUsuarioId INTEGER) RETURNS DECIMAL(20,5)
										BEGIN
										  RETURN (SELECT 
										    IFNULL(SUM(cantidad), 0) AS saldo 
										  FROM movimientos AS m
										  LEFT JOIN periodos AS p USING(periodoid)
										  LEFT JOIN contingentes AS c USING(contingenteid)
										  LEFT JOIN tratados AS t USING(tratadoid)
										  LEFT JOIN tipotratados AS tt USING(tipotratadoid)
										  WHERE p.contingenteid = aContingenteId
										  AND IF(tt.asignacion = 1, (m.tipo IN('Cuota','Asignación')), (m.tipo IN('Cuota','Certificado'))));
										END");
	}

}