<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationUniqueNit extends Migration {

	public function up() {
		Schema::table('authusuarios', function($table){
			$table->unique('nit');		
		});

		Schema::table('solicitudinscripciones', function($table){
			$table->unique('nit');		
		});
	}

	public function down() {
		Schema::table('authusuarios', function($table){
		  $table->dropUnique('authusuarios_nit_unique');
		});

		Schema::table('solicitudinscripciones', function($table){
		  $table->dropUnique('solicitudinscripciones_nit_unique');
		});
	}

}
