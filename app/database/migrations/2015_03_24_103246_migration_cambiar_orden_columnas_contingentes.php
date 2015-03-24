<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationCambiarOrdenColumnasContingentes extends Migration {

	public function up() {
		Schema::table('contingentes', function($table) {
			$table->dropForeign('contingentes_plantillaid_foreign');
			$table->dropColumn('plantillaid');
		});

		Schema::table('contingentes', function($table) {
			$table->integer('plantillaid')->unsigned()->nullable()->after('unidadmedidaid');
			$table->foreign('plantillaid')->references('plantillaid')->on('plantillascertificados')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}

	public function down() {
		Schema::table('contingentes', function($table) {
			$table->dropForeign('contingentes_plantillaid_foreign');
			$table->dropColumn('plantillaid');
		});

		Schema::table('contingentes', function($table) {
			$table->integer('plantillaid')->unsigned()->nullable()->after('textocertificado');
			$table->foreign('plantillaid')->references('plantillaid')->on('plantillascertificados')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}

}
