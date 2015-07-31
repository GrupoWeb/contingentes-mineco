<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationGetConsumoContingente extends Migration {
	public function up() {
		DB::unprepared('DROP FUNCTION IF EXISTS getConsumoPeriodo');
		DB::unprepared("CREATE FUNCTION getConsumoPeriodo(aPeriodoId INTEGER, aEmpresaId INTEGER) RETURNS DECIMAL(20,5)
			BEGIN
			  RETURN (SELECT 
			    IFNULL(SUM(cantidad*-1), 0) AS saldo 
			  FROM movimientos AS m
			  LEFT JOIN authusuarios AS u ON m.usuarioid=u.usuarioid
			  WHERE IF(aEmpresaId!=0, u.empresaid=aEmpresaId, 1)
			  AND m.periodoid = aPeriodoId 
			  AND m.tipomovimientoid = 2
			  );
			END");

		DB::unprepared('DROP FUNCTION IF EXISTS getTotalPeriodo');
		DB::unprepared("CREATE FUNCTION getTotalPeriodo(aPeriodoId INTEGER, aEmpresaId INTEGER) RETURNS DECIMAL(20,5)
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
			  	(m.tipomovimientoid IN(3,4) AND m.usuarioid IN(SELECT usuarioid FROM authusuarios WHERE empresaid=aEmpresaId)) , 
					(m.tipomovimientoid IN(1)))
			  );
			END");

		DB::unprepared('DROP FUNCTION IF EXISTS getLiquidadoPeriodo');
		DB::unprepared("CREATE FUNCTION getLiquidadoPeriodo(aPeriodoId INTEGER, aEmpresaId INTEGER) RETURNS DECIMAL(20,5)
			BEGIN
			  RETURN (SELECT 
			    IFNULL(SUM(c.real), 0) AS saldo 
			  FROM movimientos AS m
			  LEFT JOIN authusuarios AS u ON m.usuarioid=u.usuarioid
			  LEFT JOIN certificados AS c ON m.certificadoid=c.certificadoid
			  WHERE IF(aEmpresaId!=0, u.empresaid=aEmpresaId, 1)
			  AND m.periodoid = aPeriodoId 
			  AND m.tipomovimientoid = 2
			  );
			END");

		DB::unprepared('DROP FUNCTION IF EXISTS getAsignacionPeriodo');
		DB::unprepared("CREATE FUNCTION getAsignacionPeriodo(aPeriodoId INTEGER, aEmpresaId INTEGER) RETURNS DECIMAL(20,5)
			BEGIN
			  RETURN (SELECT 
			    IFNULL(SUM(cantidad), 0) AS saldo 
			  FROM movimientos AS m
			  LEFT JOIN authusuarios AS u ON m.usuarioid=u.usuarioid
			  WHERE IF(aEmpresaId!=0, u.empresaid=aEmpresaId, 1)
			  AND m.periodoid = aPeriodoId 
			  AND m.tipomovimientoid = 3
			  );
			END");
	}

	public function down() {
		DB::unprepared('DROP FUNCTION IF EXISTS getConsumoPeriodo');
		DB::unprepared('DROP FUNCTION IF EXISTS getTotalPeriodo');
		DB::unprepared('DROP FUNCTION IF EXISTS getLiquidadoPeriodo');
		DB::unprepared('DROP FUNCTION IF EXISTS getAsignacionPeriodo');
	}
}