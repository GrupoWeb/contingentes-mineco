<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationNombreCortoTratados extends Migration {

	public function up() {
		Schema::table('tratados', function(Blueprint $table) {
			$table->string('nombrecorto', 50)->nullable()->after('nombre');
		});
	}

	public function down() {
		Schema::table('tratados', function(Blueprint $table) {
			$table->dropColumn('nombrecorto');
		});
	}

}
