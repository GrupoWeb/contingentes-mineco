<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuariocontingentesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuariocontingentes', function(Blueprint $table)
		{
			$table->increments('usuariocontingenteid');
			$table->integer('usuarioid')->unsigned()->index('usuarioid');
			$table->integer('contingenteid')->unsigned()->index('productoid');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuariocontingentes');
	}

}
