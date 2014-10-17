<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuthpermisosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('authpermisos', function(Blueprint $table)
		{
			$table->increments('permisoid');
			$table->string('nombre', 50)->unique();
			$table->string('nombrefriendly', 50);
			$table->boolean('mostrar')->default(1);
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
		Schema::drop('authpermisos');
	}

}
