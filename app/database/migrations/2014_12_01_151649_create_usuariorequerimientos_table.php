<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuariorequerimientosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuariorequerimientos', function(Blueprint $table)
		{
			$table->increments('usuariorequerimientoid');
			$table->integer('usuarioid')->unsigned()->index('usuarioid');
			$table->integer('requerimientoid')->unsigned()->index('requerimientoid');
			$table->string('archivo', 200);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuariorequerimientos');
	}

}
