<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationUnidadMedidaContingentes extends Migration {

	public function up() {
		Schema::table('contingentes', function($table) {
			$table->integer('unidadmedidaid')->unsigned()->nullable()->after('productoid');
			$table->foreign('unidadmedidaid')->references('unidadmedidaid')->on('unidadesmedida')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}

	public function down() {
		Schema::table('contingentes', function($table) {
			$table->dropForeign('contingentes_unidadmedidaid_foreign');
			$table->dropColumn('unidadmedidaid');
		});
	}

}
