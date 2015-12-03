<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationColEnviadoSatCertificados extends Migration {

	public function up() {
		Schema::table('certificados', function($table) {
			$table->tinyInteger('enviadosat')->unsigned()->default(0);
		});
	}

	public function down() {
		Schema::table('certificados', function($table) {
			$table->dropColumn('enviadosat');
		});
	}
}