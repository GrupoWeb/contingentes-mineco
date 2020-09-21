<?php

use Illuminate\Database\Migrations\Migration;

class AlterPaisesAddCodigo extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paises', function ($table) {
            $table->string('codigo')->nullable()->after('nombre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paises', function ($table) {
            $table->dropColumn('codigo');
        });
    }
}
