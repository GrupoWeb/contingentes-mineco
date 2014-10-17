<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuarioproductosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarioproductos', function(Blueprint $table)
		{
			$table->increments('upid');
			$table->integer('usuarioid')->unsigned()->index('usuarioid');
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
		Schema::drop('usuarioproductos');
	}

}
