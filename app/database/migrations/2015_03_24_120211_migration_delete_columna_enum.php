<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationDeleteColumnaEnum extends Migration {

	public function up() {
		Schema::table('movimientos', function($table){
			$table->dropColumn('tipo');
		});
	}

	public function down() {
		Schema::table('movimientos', function($table){
			$table->enum('tipo', array('Cuota', 'Certificado', 'Asignación'))->after('created_by');
		});

		DB::statement('UPDATE movimientos AS m SET tipo = (SELECT nombre FROM tiposmovimiento AS tm WHERE tm.tipomovimientoid = m.tipomovimientoid)');
	}

}
