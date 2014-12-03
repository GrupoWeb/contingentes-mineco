<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationColumnaPuestoUsuario extends Migration {

	public function up() {
		Schema::table('authusuarios', function(Blueprint $table) {
			$table->string('nombrecompleto')->nullable()->after('nombre');
			$table->string('puesto')->nullable()->after('nombrecompleto');
		});
	}

	public function down() {
		Schema::table('authusuarios', function(Blueprint $table){
			$table->dropColumn('nombrecompleto');
			$table->dropColumn('puesto');
		});
	}

}
