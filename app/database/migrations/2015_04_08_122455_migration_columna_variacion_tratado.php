<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationColumnaVariacionTratado extends Migration {

	public function up() {
		Schema::table('tratados', function($table) {
			$table->integer('variacion')->nullable()->after('mesesvalidez');
		});
	}

	public function down() {
		Schema::table('tratados', function($table) {
			$table->dropColumn('variacion');
		});
	}
}
