<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationFkPlantillaidContingentes extends Migration {

	public function up() {
		Schema::table('contingentes', function($table) {
			$table->foreign('plantillaid')->references('plantillaid')->on('plantillascertificados')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}

	public function down() {
		Schema::table('contingentes', function($table) {
			$table->dropForeign('contingentes_plantillaid_foreign');
		});
	}

}
