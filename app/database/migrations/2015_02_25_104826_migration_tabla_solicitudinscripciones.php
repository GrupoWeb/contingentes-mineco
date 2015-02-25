<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationTablaSolicitudinscripciones extends Migration {

	public function up() {
		Schema::create('solicitudinscripciones', function(Blueprint $table) {
			$table->increments('solicitudinscripcionid');
			$table->enum('estado', array('Pendiente', 'Aprobada', 'Rechazada'));
			$table->string('email');
			$table->string('password');
			$table->string('nit');
			$table->string('nombre');
			$table->string('propietario');
			$table->string('domiciliofiscal');
			$table->string('domiciliocomercial');
			$table->string('direccionnotificaciones');
			$table->string('telefono');
			$table->string('fax');
			$table->string('encargadoimportaciones');
			$table->timestamps();
		});
	}

	public function down() {
		Schema::drop('solicitudinscripciones');
	}

}
