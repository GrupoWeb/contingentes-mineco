<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationAgregarActaSolicitudAsignacion extends Migration {

	public function up() {
		Schema::table('solicitudasignacion', function($table) {
			$table->string('acta')->nullable()->after('estado');
		});
	}

	public function down() {
		Schema::table('solicitudasignacion', function($table) {
			$table->dropColumn('acta');
		});
	}
}