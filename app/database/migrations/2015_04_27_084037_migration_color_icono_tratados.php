<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationColorIconoTratados extends Migration {

	public function up() {
		Schema::table('tratados', function($table) {
			$table->string('clase')->after('tipo')->nullable()->default('default');
			$table->string('icono')->after('clase')->nullable()->default('fa-file-text-o');
		});
	}

	public function down() {
		Schema::table('tratados', function($table) {
			$table->dropColumn('clase');
			$table->dropColumn('icono');
		});	
	}

}
