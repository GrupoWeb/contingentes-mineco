<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationFuncionGetSaldoConPeriodo extends Migration {

	public function up() {
		DB::unprepared('DROP FUNCTION IF EXISTS getSaldo');
		DB::unprepared("CREATE FUNCTION getSaldo(aContingenteId INTEGER, aEmpresaId INTEGER) RETURNS DECIMAL(20,5)
			BEGIN
			  RETURN (SELECT 
			    IFNULL(SUM(cantidad), 0) AS saldo 
			  FROM movimientos AS m
			  LEFT JOIN periodos AS p USING(periodoid)
			  LEFT JOIN contingentes AS c USING(contingenteid)
			  LEFT JOIN tratados AS t USING(tratadoid)
			  LEFT JOIN tipotratados AS tt USING(tipotratadoid)
			  WHERE p.contingenteid = aContingenteId
			  AND NOW() BETWEEN p.fechainicio AND p.fechafin
			  AND IF(tt.asignacion = 1, 
			  	(m.tipomovimientoid IN(3,2,4) AND m.usuarioid IN(SELECT usuarioid FROM authusuarios WHERE empresaid=aEmpresaId)) , 
					(m.tipomovimientoid IN(1,2))));
			END");

		DB::unprepared('DROP FUNCTION IF EXISTS getTotalContingente');
		DB::unprepared("CREATE FUNCTION getTotalContingente(aContingenteId INTEGER, aEmpresaId INTEGER) RETURNS DECIMAL(20,5)
			BEGIN
			  RETURN (SELECT 
			    IFNULL(SUM(cantidad), 0) AS saldo 
			  FROM movimientos AS m
			  LEFT JOIN periodos AS p USING(periodoid)
			  LEFT JOIN contingentes AS c USING(contingenteid)
			  LEFT JOIN tratados AS t USING(tratadoid)
			  LEFT JOIN tipotratados AS tt USING(tipotratadoid)
			  WHERE p.contingenteid = aContingenteId
			  AND NOW() BETWEEN p.fechainicio AND p.fechafin
			  AND IF(tt.asignacion = 1, 
			  	(m.tipomovimientoid IN(3,4) AND m.usuarioid IN(SELECT usuarioid FROM authusuarios WHERE empresaid=aEmpresaId)) , 
					(m.tipomovimientoid IN(1))));
			END");
	}

	public function down() {
		DB::unprepared('DROP FUNCTION IF EXISTS getSaldo');
		DB::unprepared("CREATE FUNCTION getSaldo(aContingenteId INTEGER, aEmpresaId INTEGER) RETURNS DECIMAL(20,5)
			BEGIN
			  RETURN (SELECT 
			    IFNULL(SUM(cantidad), 0) AS saldo 
			  FROM movimientos AS m
			  LEFT JOIN periodos AS p USING(periodoid)
			  LEFT JOIN contingentes AS c USING(contingenteid)
			  LEFT JOIN tratados AS t USING(tratadoid)
			  LEFT JOIN tipotratados AS tt USING(tipotratadoid)
			  WHERE p.contingenteid = aContingenteId
			  AND NOW() BETWEEN p.fechainicio AND p.fechafin
			  AND IF(tt.asignacion = 1, 
			  	(m.tipo IN('Asignacion','Certificado') AND m.usuarioid IN(SELECT usuarioid FROM authusuarios WHERE empresaid=aEmpresaId)) , 
					(m.tipo IN('Cuota','Certificado'))));
			END");

		DB::unprepared('DROP FUNCTION IF EXISTS getTotalContingente');
		DB::unprepared("CREATE FUNCTION getTotalContingente(aContingenteId INTEGER, aEmpresaId INTEGER) RETURNS DECIMAL(20,5)
			BEGIN
			  RETURN (SELECT 
			    IFNULL(SUM(cantidad), 0) AS saldo 
			  FROM movimientos AS m
			  LEFT JOIN periodos AS p USING(periodoid)
			  LEFT JOIN contingentes AS c USING(contingenteid)
			  LEFT JOIN tratados AS t USING(tratadoid)
			  LEFT JOIN tipotratados AS tt USING(tipotratadoid)
			  WHERE p.contingenteid = aContingenteId
			  AND NOW() BETWEEN p.fechainicio AND p.fechafin
			  AND IF(tt.asignacion = 1, 
			  	(m.tipomovimientoid IN(3,4) AND m.usuarioid IN(SELECT usuarioid FROM authusuarios WHERE empresaid=aEmpresaId)) , 
					(m.tipomovimientoid IN(1))));
			END");
	}

}
