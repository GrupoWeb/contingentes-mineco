<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationTablaConstancias extends Migration {

	public function up() {
		Schema::create('constancias', function($table) {
			$table->increments('constanciaid');
			$table->integer('movimientoid')->unsigned();
			$table->string('archivo');
			$table->timestamps();

			$table->foreign('movimientoid')->references('movimientoid')->on('movimientos');
		});
	}

	public function down() {
		Schema::drop('constancias');
	}

}
