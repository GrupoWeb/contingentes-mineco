<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCertificadosAddPartidaid extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificados', function (Blueprint $table) {
            $table->unsignedInteger('partidaid')->nullable()->after('paisid');

            $table->foreign('partidaid')->references('partidaid')->on('contingentepartidas');
        });

        DB::unprepared('UPDATE certificados SET partidaid=(SELECT cp.partidaid FROM contingentepartidas AS cp
        	LEFT JOIN contingentes AS c ON cp.contingenteid=c.contingenteid
        	LEFT JOIN tratados AS t ON c.tratadoid=t.tratadoid
        	WHERE cp.partida=LEFT(certificados.fraccion,LOCATE(" ",certificados.fraccion) - 1)
        	AND t.nombre=certificados.tratado LIMIT 1)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certificados', function (Blueprint $table) {
            $table->dropForeign(['partidaid']);
            $table->dropColumn('partidaid');
        });
    }

}
