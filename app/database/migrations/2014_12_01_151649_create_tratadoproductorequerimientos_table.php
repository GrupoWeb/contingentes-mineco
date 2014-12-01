<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTratadoproductorequerimientosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tratadoproductorequerimientos', function(Blueprint $table)
		{
			$table->increments('tratadoproductorequerimientoid');
			$table->integer('tratadoproductoid')->unsigned()->index('productorequerimientos_ibfk_1');
			$table->integer('requerimientoid')->unsigned()->index('requerimientoid');
			$table->enum('tipo', array('inscripcion','asignacion','emision'))->default('inscripcion');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tratadoproductorequerimientos');
	}

}
