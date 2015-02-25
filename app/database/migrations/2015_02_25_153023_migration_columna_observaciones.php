<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationColumnaObservaciones extends Migration {

	public function up() {
		Schema::table('solicitudinscripciones', function($table){
			$table->text('observaciones')->after('estado');
		});
	}

	public function down() {
		Schema::table('solicitudinscripciones', function($table){
			$table->dropColumn('observaciones');
		});
	}

}
