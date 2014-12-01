<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTratadoproductopartidasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tratadoproductopartidas', function(Blueprint $table)
		{
			$table->increments('partidaid');
			$table->integer('tratadoproductoid')->unsigned()->index('productoid');
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
		Schema::drop('tratadoproductopartidas');
	}

}
