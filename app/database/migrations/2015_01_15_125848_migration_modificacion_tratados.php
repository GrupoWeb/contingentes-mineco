<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationModificacionTratados extends Migration {

	public function up() {
		Schema::table('tratados', function(Blueprint $table) {
			$table->dropForeign('tratados_tipotratadoid_foreign');
			$table->dropColumn('tipotratadoid');
		});
	}

	public function down() {
		Schema::table('tratados', function(Blueprint $table) {
			$table->integer('tipotratadoid')->unsigned()->nullable()->after('tratadoid');
			$table->foreign('tipotratadoid')->references('tipotratadoid')->on('tipotratados')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}

}
