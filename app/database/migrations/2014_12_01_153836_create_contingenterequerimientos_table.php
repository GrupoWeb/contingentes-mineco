<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContingenterequerimientosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contingenterequerimientos', function(Blueprint $table)
		{
			$table->increments('contingenterequerimientoid');
			$table->integer('contingenteid')->unsigned()->index('productorequerimientos_ibfk_1');
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
		Schema::drop('contingenterequerimientos');
	}

}
