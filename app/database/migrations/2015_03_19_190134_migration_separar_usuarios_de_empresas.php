<?php

use Illuminate\Database\Migrations\Migration;

class MigrationSepararUsuariosDeEmpresas extends Migration
{

    public function up()
    {
        Schema::create('empresas', function ($table) {
            $table->increments('empresaid');
            $table->string('nit', 20)->nullable();
            $table->string('razonsocial');
            $table->string('propietario');
            $table->string('domiciliofiscal');
            $table->string('domiciliocomercial');
            $table->string('direccionnotificaciones');
            $table->string('telefono');
            $table->string('fax');
            $table->string('encargadoimportaciones');
            $table->timestamps();

            $table->unique('nit');
        });
        DB::unprepared('INSERT INTO empresas
			(empresaid, nit, razonsocial, propietario, domiciliofiscal,
				domiciliocomercial, direccionnotificaciones, telefono, fax,
				encargadoimportaciones)
			SELECT usuarioid, nit, razonsocial, propietario, domiciliofiscal,
				domiciliocomercial, direccionnotificaciones, telefono, fax,
				encargadoimportaciones FROM authusuarios WHERE rolid=3');

        Schema::table('authusuarios', function ($table) {
            $table->dropColumn('nit');
            $table->dropColumn('razonsocial');
            $table->dropColumn('propietario');
            $table->dropColumn('domiciliofiscal');
            $table->dropColumn('domiciliocomercial');
            $table->dropColumn('direccionnotificaciones');
            $table->dropColumn('telefono');
            $table->dropColumn('fax');
            $table->dropColumn('encargadoimportaciones');
            $table->integer('empresaid')->nullable()->unsigned()->after('rolid');
            $table->foreign('empresaid')->references('empresaid')->on('empresas')->onUpdate('cascade');
        });

        DB::unprepared('UPDATE authusuarios SET empresaid=usuarioid WHERE rolid=3');

        //Ahora cambiamos la tabla usuariocontingentes por empresacontingentes
        Schema::create('empresacontingentes', function ($table) {
            $table->increments('empresacontingenteid');
            $table->integer('empresaid')->unsigned();
            $table->integer('contingenteid')->unsigned();
            $table->timestamps();
            $table->foreign('empresaid')->references('empresaid')->on('empresas')->onUpdate('cascade');
            $table->foreign('contingenteid')->references('contingenteid')->on('contingentes')->onUpdate('cascade');
        });
        DB::unprepared('INSERT INTO empresacontingentes
			(empresaid, contingenteid, created_at, updated_at)
			SELECT usuarioid, contingenteid, created_at, updated_at FROM usuariocontingentes');
        Schema::drop('usuariocontingentes');

        //Borrar tabla legacy
        Schema::dropIfExists('usuarioproductos');

        Schema::create('empresarequerimientos', function ($table) {
            $table->increments('empresarequerimientoid');
            $table->integer('empresaid')->unsigned()->index('empresaid');
            $table->integer('requerimientoid')->unsigned()->index('requerimientoid');
            $table->string('archivo', 200);
            $table->timestamps();
            $table->foreign('empresaid')->references('empresaid')->on('empresas')->onUpdate('cascade');
            $table->foreign('requerimientoid')->references('requerimientoid')->on('requerimientos')->onUpdate('cascade');
        });
        DB::unprepared('INSERT INTO empresarequerimientos
			(empresaid, requerimientoid, archivo, created_at, updated_at)
			SELECT usuarioid, requerimientoid, archivo, created_at, updated_at FROM usuariorequerimientos');
        Schema::drop('usuariorequerimientos');

        //Funcion getSaldo ahora recibe empresaid
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
										  AND IF(tt.asignacion = 1,
										  	(m.tipo IN('Asignacion','Certificado') AND m.usuarioid IN(SELECT usuarioid FROM authusuarios WHERE empresaid=aEmpresaId)) ,
												(m.tipo IN('Cuota','Certificado'))));
										END");

    }

    public function down()
    {
        //function getSaldo recibe UsuarioId
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
										  AND IF(tt.asignacion = 1, (m.tipo IN('Asignacion','Certificado') AND m.usuarioid=aUsuarioId), (m.tipo IN('Cuota','Certificado'))));
										END");

        Schema::create('usuariorequerimientos', function ($table) {
            $table->increments('usuariorequerimientoid');
            $table->integer('usuarioid')->unsigned()->index('usuarioid');
            $table->integer('requerimientoid')->unsigned()->index('requerimientoid');
            $table->string('archivo', 200);
            $table->timestamps();
        });
        DB::unprepared('INSERT INTO usuariorequerimientos
			(usuarioid, requerimientoid, archivo, created_at, updated_at)
			SELECT empresaid, requerimientoid, archivo, created_at, updated_at FROM empresarequerimientos');

        Schema::drop('empresarequerimientos');

        Schema::create('usuariocontingentes', function ($table) {
            $table->increments('usuariocontingenteid');
            $table->integer('usuarioid')->unsigned();
            $table->integer('contingenteid')->unsigned();
            $table->timestamps();
            $table->foreign('usuarioid')->references('usuarioid')->on('authusuarios')->onUpdate('cascade');
            $table->foreign('contingenteid')->references('contingenteid')->on('contingentes')->onUpdate('cascade');
        });

        DB::unprepared('INSERT INTO usuariocontingentes
			(usuarioid, contingenteid, created_at, updated_at)
			SELECT empresaid, contingenteid, created_at, updated_at FROM empresacontingentes');
        Schema::drop('empresacontingentes');

        Schema::table('authusuarios', function ($table) {
            $table->dropForeign('authusuarios_empresaid_foreign');
            $table->dropColumn('empresaid');
            $table->string('nit', 20)->nullable();
            $table->string('razonsocial');
            $table->string('propietario');
            $table->string('domiciliofiscal');
            $table->string('domiciliocomercial');
            $table->string('direccionnotificaciones');
            $table->string('telefono');
            $table->string('fax');
            $table->string('encargadoimportaciones');
        });

        Schema::drop('empresas');

    }
}
