<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationTablaNoticias extends Migration {

	public function up() {
		Schema::create('noticias', function($table) {
			$table->increments('noticiaid');
			$table->string('titulo');
			$table->text('contenido');
			$table->string('imagen');
			$table->timestamps();
		});
	}

	public function down() {
		Schema::drop('noticias');
	}
}