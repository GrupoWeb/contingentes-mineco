<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductorequerimientosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('productorequerimientos', function(Blueprint $table)
		{
			$table->increments('priid');
			$table->integer('productoid')->unsigned()->index('productorequerimientos_ibfk_1');
			$table->integer('requerimientoid')->unsigned()->index('requerimientoid');
			$table->enum('tipo', array('Inscripción','Asignación','Emisión'))->default('Inscripción');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('productorequerimientos');
	}

}
