<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationColumnaAnuladoCertificados extends Migration {

	public function up() {
		Schema::table('certificados', function(Blueprint $table) {
			$table->tinyinteger('anulado')->unsigned()->default(0)->after('usuarioid');
		});
	}

	public function down() {
		Schema::table('certificados', function(Blueprint $table) {
			$table->dropColumn('anulado');
		});
	}

}
