<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductopartidasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('productopartidas', function(Blueprint $table)
		{
			$table->increments('partidaid');
			$table->integer('productoid')->unsigned()->index('productoid');
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
		Schema::drop('productopartidas');
	}

}
