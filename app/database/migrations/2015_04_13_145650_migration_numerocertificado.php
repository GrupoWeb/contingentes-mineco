<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationNumerocertificado extends Migration {

	public function up() {
		Schema::table('certificados', function($table) {
			$table->string('numerocertificado')->nullable()->after('certificadoid');
		});
	}

	public function down() {
		Schema::table('certificados', function($table) {
			$table->dropColumn('numerocertificado');
		});
	}

}
