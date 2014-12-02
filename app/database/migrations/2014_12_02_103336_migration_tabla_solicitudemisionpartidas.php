<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationTablaSolicitudemisionpartidas extends Migration {

	public function up() {
		Schema::create('solicitudemisionpartidas', function(Blueprint $table) {
			$table->increments('solicitudemisionpartidaid');
			$table->integer('usuarioid')->unsigned();
			$table->integer('periodoid')->unsigned();
			$table->integer('partidaid')->unsigned();
			$table->decimal('solicitado', 20, 5);
			$table->decimal('emitido', 20, 5)->nullable();
			$table->enum('estado', array('Pendiente', 'Aprobada', 'Rechazada'));
			$table->text('observaciones')->nullable();
			$table->timestamps();

			$table->foreign('usuarioid')->references('usuarioid')->on('authusuarios')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('periodoid')->references('periodoid')->on('periodos')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('partidaid')->references('partidaid')->on('contingentepartidas')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}

	public function down() {
		Schema::drop('solicitudemisionpartidas');
	}

}
