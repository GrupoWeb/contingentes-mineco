<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationColumnaVariacionCertificado extends Migration {

	public function up() {
		Schema::table('certificados', function($table) {
			$table->integer('variacion')->nullable()->after('volumen');
		});
	}

	public function down() {
		Schema::table('certificados', function($table) {
			$table->dropColumn('variacion');
		});
	}
}