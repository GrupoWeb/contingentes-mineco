<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateTableSolicitudautorizacion extends Migration {

	public function up()
	{
		Schema::create('solicitudactualizacion', function($table){
			$table->increments('actualizacionid');
			$table->integer('usuarioid')->unsigned();
			$table->string('nit', 20)->nullable();
			$table->string('razonsocial');
			$table->string('propietario');
			$table->string('domiciliofiscal');
			$table->string('domiciliocomercial');
			$table->string('direccionnotificaciones');
			$table->string('telefono');
			$table->string('fax');
			$table->string('encargadoimportaciones');
			$table->string('codigovupe');
			$table->enum('estado', array('Aprobada', 'Pendiente', 'Rechazada'))->default('Pendiente')	;
			$table->timestamps();
			$table->foreign('usuarioid')->references('usuarioid')->on('authusuarios')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});

	}
	public function down()
	{
		Schema::drop('solicitudactualizacion');
	}

}
