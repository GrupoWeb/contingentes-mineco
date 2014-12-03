<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationTablaEmisionRequerimientos extends Migration {

	public function up() {
		Schema::create('solicitudemisionrequerimientos', function(Blueprint $table) {
			$table->increments('solicitudemisionrequerimientoid');
			$table->integer('solicitudemisionid')->unsigned();
			$table->integer('requerimientoid')->unsigned();
			$table->string('archivo',200);
			$table->timestamps();

			$table->foreign('solicitudemisionid')->references('solicitudemisionid')->on('solicitudesemision')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('requerimientoid')->references('requerimientoid')->on('requerimientos')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}

	public function down() {
		Schema::drop('solicitudemisionrequerimientos');
	}

}
