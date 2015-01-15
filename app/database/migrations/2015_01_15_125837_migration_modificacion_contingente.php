<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationModificacionContingente extends Migration {

	public function up() {
		Schema::table('contingentes', function(Blueprint $table) {
			$table->integer('tipotratadoid')->unsigned()->nullable()->after('tratadoid');
			$table->integer('mesesvalido')->unsigned()->nullable()->after('tipotratadoid');
			$table->foreign('tipotratadoid')->references('tipotratadoid')->on('tipotratados')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}

	public function down() {
		Schema::table('contingentes', function(Blueprint $table) {
			$table->dropForeign('contingentes_tipotratadoid_foreign');
			$table->dropColumn('tipotratadoid');
			$table->dropColumn('mesesvalido');
		});
	}

}
