<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationTimestampsContingentes extends Migration {

	public function up() {
		Schema::table('contingentes', function($table) {
    	$table->timestamps();
		});
	}

	public function down() {
		Schema::table('contingentes', function($table) {
			$table->dropTimestamps();
		});
	}

}
