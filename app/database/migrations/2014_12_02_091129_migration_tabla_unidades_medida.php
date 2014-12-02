<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationTablaUnidadesMedida extends Migration {

	public function up() {
		Schema::create('unidadesmedida', function(Blueprint $table) {
			$table->increments('unidadmedidaid');
			$table->string('nombre', 255);
			$table->string('nombrecorto', 50);
			$table->timestamps();
		});
	}

	public function down() {
		Schema::drop('unidadesmedida');
	}

}
