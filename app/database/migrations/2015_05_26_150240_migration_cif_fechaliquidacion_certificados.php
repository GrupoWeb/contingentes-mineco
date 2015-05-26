<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationCifFechaliquidacionCertificados extends Migration {

	public function up() {
		Schema::table('certificados', function($table) {
			$table->decimal('cif', 15, 4)->nullable()->after('real');
			$table->datetime('fechaliquidacion')->nullable()->after('fechavencimiento');
		});
	}

	public function down() {
		Schema::table('certificados', function($table) {
			$table->dropColumn('cif');
			$table->dropColumn('fechaliquidacion');
		});
	}
}