<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationPlantillasCertificados extends Migration {

	public function up() {
		Schema::create('plantillascertificados', function(Blueprint $table){
			$table->increments('plantillaid');
			$table->string('nombre');
			$table->string('vista', 50);
			$table->timestamps();
		});	

		Schema::table('contingentes', function(Blueprint $table) {
			$table->integer('plantillaid')->unsigned()->nullable()->after('textocertificado');
			$table->foreign('plantillaid')->references('plantillaid')->on('plantillascertificados')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}

	public function down() {
		Schema::table('contingentes', function(Blueprint $table) {
			$table->dropForeign('contingentes_plantillaid_foreign');
			$table->dropColumn('plantillaid');
		});

		Schema::drop('plantillascertificados');
	}

}
