<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationEmpresasNumerovupe extends Migration {

	public function up() {
		Schema::table('empresas', function($table){
			$table->string('codigovupe')->after('encargadoimportaciones')->nullable();
		});
		Schema::table('solicitudinscripciones', function($table){
			$table->string('codigovupe')->after('encargadoimportaciones')->nullable();
		});
		Schema::table('certificados', function($table){
			$table->string('codigovupe')->after('nit')->nullable();
		});
	}

	public function down() {
		Schema::table('empresas', function($table){
			$table->dropColumn('codigovupe');
		});
		Schema::table('certificados', function($table){
			$table->dropColumn('codigovupe');
		});
		
		Schema::table('solicitudinscripciones', function($table){
			$table->dropColumn('codigovupe');
		});
		
	}

}
