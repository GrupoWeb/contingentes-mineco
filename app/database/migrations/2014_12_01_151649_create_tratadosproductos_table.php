<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTratadosproductosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tratadosproductos', function(Blueprint $table)
		{
			$table->increments('tratadoproductoid');
			$table->integer('tratadoid')->unsigned()->index('tratadoint');
			$table->integer('productoid')->unsigned()->index('productoid');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tratadosproductos');
	}

}
