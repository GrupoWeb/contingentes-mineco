<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationColumnaTipoMovimiento extends Migration {

	public function up() {
		Schema::table('movimientos', function(Blueprint $table) {
			$table->enum('tipo', array('Cuota', 'Certificado', 'Asignación'))->after('created_by');
		});
	}

	public function down() {
		Schema::table('movimientos', function(Blueprint $table) {
			$table->dropColumn('tipo');
		});
	}
}
