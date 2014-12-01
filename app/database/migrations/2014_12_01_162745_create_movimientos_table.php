<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMovimientosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('movimientos', function(Blueprint $table)
		{
			$table->increments('movimientoid');
			$table->integer('periodoid')->unsigned()->index('periodoid');
			$table->integer('usuarioid')->unsigned()->nullable()->index('usuarioid');
			$table->decimal('cantidad', 20, 5);
			$table->text('comentario')->nullable();
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
		Schema::drop('movimientos');
	}

}
