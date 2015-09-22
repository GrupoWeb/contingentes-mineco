<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationFuncionGetSaldoPeriodo extends Migration {

	public function up() {
		DB::unprepared('DROP FUNCTION IF EXISTS getSaldoPeriodo');
		DB::unprepared("CREATE FUNCTION getSaldoPeriodo(aPeriodoId INTEGER, aEmpresaId INTEGER) RETURNS decimal(20,5)
			BEGIN
			  RETURN (SELECT 
			    IFNULL(SUM(cantidad), 0) AS saldo 
			  FROM movimientos AS m
			  LEFT JOIN periodos AS p USING(periodoid)
			  LEFT JOIN contingentes AS c USING(contingenteid)
			  LEFT JOIN tratados AS t USING(tratadoid)
			  LEFT JOIN tipotratados AS tt USING(tipotratadoid)
			  LEFT JOIN authusuarios AS u ON m.usuarioid=u.usuarioid
			  WHERE m.periodoid = aPeriodoId
			  AND IF(tt.asignacion = 1, 
			  	(m.tipomovimientoid IN(2,4) AND m.usuarioid IN(SELECT usuarioid FROM authusuarios WHERE empresaid=aEmpresaId)), 
					(m.tipomovimientoid IN(1,3,4)))
			  );
			END;");
	}

	public function down() {
		DB::unprepared('DROP FUNCTION IF EXISTS getSaldoPeriodo');
	}

}


