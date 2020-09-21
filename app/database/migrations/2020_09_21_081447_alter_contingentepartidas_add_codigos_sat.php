<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterContingentepartidasAddCodigosSat extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contingentepartidas', function (Blueprint $table) {
            $table->string('codigo_cuota')->after('nombre');
            $table->string('codigo_adicional')->default('')->after('codigo_cuota');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contingentepartidas', function (Blueprint $table) {
            $table->dropColumn('codigo_cuota');
            $table->dropColumn('codigo_adicional');
        });
    }

}
