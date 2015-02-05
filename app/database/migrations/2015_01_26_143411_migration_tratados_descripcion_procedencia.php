<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationTratadosDescripcionProcedencia extends Migration {

	public function up() {
		Schema::table('tratados', function(Blueprint $table) {
			$table->text('textocertificado')->after('nombrecorto');	
			$table->string('paisprocedencia')->after('textocertificado');	
		});	
	}

	public function down() {
		Schema::table('tratados', function(Blueprint $table) {
			$table->dropColumn('textocertificado');
			$table->dropColumn('paisprocedencia');
		});
	}
}