<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuthrolmodulopermisosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('authrolmodulopermisos', function(Blueprint $table)
		{
			$table->increments('rolmodulopermisoid');
			$table->integer('rolid')->unsigned()->index('authrolmodulopermisos_rolid_foreign');
			$table->integer('modulopermisoid')->unsigned()->index('authrolmodulopermisos_modulopermisoid_foreign');
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
		Schema::drop('authrolmodulopermisos');
	}

}
