<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContingentepartidasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contingentepartidas', function(Blueprint $table)
		{
			$table->increments('partidaid');
			$table->integer('contingenteid')->unsigned()->index('productoid');
			$table->string('partida', 200)->nullable();
			$table->string('nombre', 200);
			$table->boolean('activo')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contingentepartidas');
	}

}
