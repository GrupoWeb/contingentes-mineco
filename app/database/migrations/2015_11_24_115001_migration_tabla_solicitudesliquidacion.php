<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationTablaSolicitudesliquidacion extends Migration {

	public function up() {
		Schema::create('solicitudesliquidacion', function($table) {
			$table->increments('solicitudliquidacionid');
			$table->integer('usuarioid')->unsigned();
			$table->integer('certificadoid')->unsigned();
			$table->enum('estado', ['Pendiente','Aprobada','Rechazada']);
			$table->string('dua');
			$table->decimal('real', 20, 5);
			$table->decimal('cif', 15, 4);
			$table->string('documento');
			$table->datetime('fechaliquidacion');
			$table->text('observaciones');
			$table->timestamps();

			$table->foreign('usuarioid')->references('usuarioid')->on('authusuarios');
			$table->foreign('certificadoid')->references('certificadoid')->on('certificados');
		});
	}

	public function down() {
		Schema::drop('solicitudesliquidacion');
	}
}