<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateAgregarColumnaTablaNoticias extends Migration {

	public function up() {
		Schema::table('noticias', function($table) {
			$table->string('documento')->nullable()->after('imagen');
		});
	}

	public function down() {
		Schema::table('noticias', function($table) {
			$table->dropColumn('documento');
		});
	}
}
