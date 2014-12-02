<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationFuncionSaldo extends Migration {

	public function up() {
		DB::unprepared("CREATE FUNCTION getSaldo(aContingenteId INTEGER, aUsuarioId INTEGER) RETURNS DECIMAL(20,5)
										BEGIN
										  RETURN (SELECT 
										    IFNULL(SUM(cantidad), 0) AS saldo 
										  FROM movimientos AS m
										  LEFT JOIN periodos AS p USING(periodoid)
										  LEFT JOIN contingentes AS c USING(contingenteid)
										  LEFT JOIN tratados AS t USING(tratadoid)
										  WHERE p.contingenteid = aContingenteId
										  AND IF(t.tipotratadoid = 1, (m.usuarioid <> 0 OR m.usuarioid IS NULL), m.usuarioid = aUsuarioId));
										END");
	}

	public function down() {
		DB::unprepared('DROP FUNCTION getSaldo');
	}

}
