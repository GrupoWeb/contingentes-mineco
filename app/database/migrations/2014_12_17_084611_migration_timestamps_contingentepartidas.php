<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationTimestampsContingentepartidas extends Migration {

	public function up() {
		Schema::table('contingentepartidas', function($table) {
    	$table->timestamps();
		});
	}

	public function down() {
		Schema::table('contingentepartidas', function($table) {
			$table->dropTimestamps();
		});
	}

}
