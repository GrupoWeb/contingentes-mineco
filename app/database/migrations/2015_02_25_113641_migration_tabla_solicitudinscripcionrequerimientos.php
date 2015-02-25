<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationTablaSolicitudinscripcionrequerimientos extends Migration {

	public function up() {
		Schema::create('solicitudinscripcionrequemientos', function(Blueprint $table) {
			$table->increments('solicitudinscripcionrequerimientoid');
			$table->integer('solicitudinscripcionid')->unsigned();
			$table->integer('requerimientoid')->unsigned();
			$table->string('archivo', 200);
			$table->timestamps();

			$table->foreign('solicitudinscripcionid')->references('solicitudinscripcionid')->on('solicitudinscripciones')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('requerimientoid')->references('requerimientoid')->on('requerimientos')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}

	public function down() {
		Schema::drop('solicitudinscripcionrequemientos');
	}

}
