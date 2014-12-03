<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationTablaEmisionPartidas extends Migration {

	public function up() {
		Schema::create('solicitudemisionpartidas', function(Blueprint $table) {
			$table->increments('solicitudemisionpartidaid');
			$table->integer('solicitudemisionid')->unsigned();
			$table->integer('partidaid')->unsigned();
			$table->timestamps();

			$table->foreign('solicitudemisionid')->references('solicitudemisionid')->on('solicitudesemision')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('partidaid')->references('partidaid')->on('contingentepartidas')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}

	public function down() {
		Schema::drop('solicitudemisionpartidas');
	}

}
