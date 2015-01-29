<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationCamposLiquidacionCertificados extends Migration {

	public function up() {
		Schema::table('certificados', function(Blueprint $table) {
			$table->string('dua')->nullable()->after('correlativo');
			$table->decimal('real', 20, 5)->after('dua');
		});
	}

	public function down() {
		Schema::table('certificados', function(Blueprint $table) {
			$table->dropColumn('dua');
			$table->dropColumn('real');
		});
	}

}
