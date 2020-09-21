<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTratadosAddCodigo extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tratados', function (Blueprint $table) {
            $table->string('codigo', 10)->after('nombrecorto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tratados', function (Blueprint $table) {
            $table->dropColumn('codigo');
        });
    }

}
