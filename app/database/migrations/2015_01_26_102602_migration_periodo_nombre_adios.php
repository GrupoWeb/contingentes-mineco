<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationPeriodoNombreAdios extends Migration {

	public function up() {
		Schema::table('periodos', function(Blueprint $table) {
			$table->dropColumn('nombre');
		});
	}

	public function down() {
		Schema::table('periodos', function(Blueprint $table) {
		$table->string('nombre')->nullable();	
		});	
	}

}
