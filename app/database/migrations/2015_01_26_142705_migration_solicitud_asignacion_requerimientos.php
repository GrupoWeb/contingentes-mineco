<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationSolicitudAsignacionRequerimientos extends Migration {

	public function up() {
		Schema::create('solicitudasignacionrequerimientos', function(Blueprint $table) {
			$table->increments('solicitudasignacionrequerimientoid');
			$table->integer('solicitudasignacionid')->unsigned();
			$table->integer('requerimientoid')->unsigned();
			$table->string('archivo',200);
			$table->timestamps();

			$table->foreign('solicitudasignacionid')->references('solicitudasignacionid')->on('solicitudasignacion')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('requerimientoid')->references('requerimientoid')->on('requerimientos')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}

	public function down() {
		Schema::drop('solicitudasignacionrequerimientos');
	}

}
