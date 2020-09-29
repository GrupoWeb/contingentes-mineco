<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUnidadesmedidaAddSat extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('unidadesmedida', function (Blueprint $table) {
            $table->decimal('factor_sat', 12, 5)->default(1)->after('nombrecorto');
            $table->string('unidad_sat', 10)->default('')->after('factor_sat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unidadesmedida', function (Blueprint $table) {
            $table->dropColumn('factor_sat');
            $table->dropColumn('unidad_sat');
        });
    }
}
