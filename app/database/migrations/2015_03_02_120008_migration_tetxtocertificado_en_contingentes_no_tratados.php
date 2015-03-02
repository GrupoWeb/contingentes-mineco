<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationTetxtocertificadoEnContingentesNoTratados extends Migration {

	public function up() {
		Schema::table('tratados', function(Blueprint $table) {
			$table->dropColumn('textocertificado');
		});

		Schema::table('contingentes', function(Blueprint $table) {
			$table->text('textocertificado')->after('productoid');
		});
	}

	public function down() {
		Schema::table('tratados', function(Blueprint $table) {
			$table->text('textocertificado')->after('nombrecorto');
		});

		Schema::table('contingentes', function(Blueprint $table) {
			$table->dropColumn('textocertificado');
		});
	}

}
