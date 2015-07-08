<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationQuitarUniqueSolicitudinscripciones extends Migration {

	public function up() {
		Schema::table('solicitudinscripciones', function($table){
   		$table->dropUnique('solicitudinscripciones_nit_unique');		
   	});
	}

	public function down() {
		Schema::table('solicitudinscripciones', function($table){
   		$table->unique('nit');		
   	});
	}

}
