<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationDuracionTratado extends Migration {

	public function up() {
		Schema::table('tratados', function(Blueprint $table) {
			$table->integer('mesesvalidez')->unsigned()->nullable()->after('tipo');
		});
	}

	public function down() {
		Schema::table('tratados', function(Blueprint $table) {
			$table->dropColumn('mesesvalidez');
		});
	}

}
