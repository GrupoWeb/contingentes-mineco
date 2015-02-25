<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationDropcolumActivoUsuariocontingentes extends Migration {

	public function up() {
		Schema::table('usuariocontingentes', function($table){
			$table->dropColumn('activo');
		});
	}

	public function down() {
		Schema::table('usuariocontingentes', function($table){
			$table->tinyinteger('activo')->unsigned()->default(0)->after('contingenteid');
		});
	}

}
