<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationNombrecortoTipotratados extends Migration {

	public function up() {
		Schema::table('tipotratados', function($table) {
			$table->string('nombrecorto')->nullable()->after('nombre');
		});
	}

	public function down() {
		Schema::table('tipotratados', function($table) {
			$table->dropColumn('nombrecorto');
		});
	}

}
