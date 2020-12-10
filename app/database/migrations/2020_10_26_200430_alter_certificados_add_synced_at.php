<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCertificadosAddSyncedAt extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificados', function (Blueprint $table) {
            $table->datetime('sat_at')->nullable()->after('fechaliquidacion');
            $table->string('sat_codigo')->nullable()->after('tratadodescripcion');
            $table->string('sat_error')->nullable()->after('sat_codigo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certificados', function (Blueprint $table) {
            $table->dropColumn('sat_at');
            $table->dropColumn('sat_codigo');
            $table->dropColumn('sat_error');
        });
    }

}
