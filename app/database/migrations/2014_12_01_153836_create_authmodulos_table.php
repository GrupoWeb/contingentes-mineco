<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuthmodulosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('authmodulos', function(Blueprint $table)
		{
			$table->increments('moduloid');
			$table->string('nombre', 50)->unique();
			$table->string('nombrefriendly', 50);
			$table->boolean('mostrar')->default(1);
			$table->string('descripcion');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('authmodulos');
	}

}
