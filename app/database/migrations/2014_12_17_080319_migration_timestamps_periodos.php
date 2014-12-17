<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationTimestampsPeriodos extends Migration {

	public function up() {
		Schema::table('periodos', function($table) {
    	$table->timestamps();
		});
	}

	public function down() {
		Schema::table('periodos', function($table) {
			$table->dropTimestamps();
		});
	}

}
