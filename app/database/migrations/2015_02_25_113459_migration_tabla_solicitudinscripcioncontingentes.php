<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationTablaSolicitudinscripcioncontingentes extends Migration {

	public function up() {
		Schema::create('solicitudinscripcioncontingentes', function(Blueprint $table) {
			$table->increments('solicitudinscripcioncontingenteid');
			$table->integer('solicitudinscripcionid')->unsigned();
			$table->integer('contingenteid')->unsigned();
			$table->timestamps();

			$table->foreign('solicitudinscripcionid')->references('solicitudinscripcionid')->on('solicitudinscripciones')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('contingenteid')->references('contingenteid')->on('contingentes')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}

	public function down() {
		Schema::drop('solicitudinscripcioncontingentes');
	}

}
