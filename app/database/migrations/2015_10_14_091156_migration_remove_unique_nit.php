<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationRemoveUniqueNit extends Migration {

	public function up() {
		Schema::table('empresas', function($table) {
			$table->dropUnique('empresas_nit_unique');
		});
	}

	public function down() {
		Schema::table('empresas', function($table) {
			$table->unique('nit');
		});
	}
}