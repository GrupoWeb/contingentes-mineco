<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationCreateTableSolicitudautorizacionrequerimiento extends Migration {

	public function up() {
		Schema::create('solicitudactualizacionrequerimientos', function($table){
			$table->increments('id');
			$table->integer('actualizacionid')->unsigned();
			$table->string('archivo');
			$table->timestamps();

			$table->foreign('actualizacionid')
				->references('actualizacionid')
				->on('solicitudactualizacion')
				->onUpdate('CASCADE')
				->onDelete('RESTRICT');
		});

	}

	public function down() {
		Schema::drop('solicitudactualizacionrequerimientos');
	}


}
