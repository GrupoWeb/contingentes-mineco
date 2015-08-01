<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationCreateTableSolicitudautorizacionrequerimiento extends Migration {

	public function up()
	{
		Schema::create('solicitudautorizacionrequerimiento', function($table){
			$table->increments('id');
			$table->integer('solicitudautorizacionid')->unsigned();
			$table->string('archivo');
			$table->timestamps();
			$table->foreign('solicitudautorizacionid')->references('solicitudautorizacionid')->on('solicitudautorizacion')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});

	}
	public function down()
	{
		Schema::drop('solicitudautorizacionrequerimiento');
	}


}
