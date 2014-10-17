<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuthmodulopermisosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('authmodulopermisos', function(Blueprint $table)
		{
			$table->increments('modulopermisoid');
			$table->integer('moduloid')->unsigned()->index('authmodulopermisos_moduloid_foreign');
			$table->integer('permisoid')->unsigned()->index('authmodulopermisos_permisoid_foreign');
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
		Schema::drop('authmodulopermisos');
	}

}
