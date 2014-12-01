<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuariotratadoproductosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuariotratadoproductos', function(Blueprint $table)
		{
			$table->increments('usuariotratadoproductoid');
			$table->integer('usuarioid')->unsigned()->index('usuarioid');
			$table->integer('tratadoproductoid')->unsigned()->index('productoid');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuariotratadoproductos');
	}

}
