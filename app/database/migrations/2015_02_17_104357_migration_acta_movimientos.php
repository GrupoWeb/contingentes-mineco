<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationActaMovimientos extends Migration {

	public function up() {
		Schema::table('movimientos', function($table){
			$table->string('acta')->after('comentario');
		});
	}

	public function down() {
		Schema::table('movimientos', function($table){
			$table->dropColumn('acta');
		});
	}

}
