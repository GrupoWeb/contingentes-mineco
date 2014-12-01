<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogerroresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logerrores', function(Blueprint $table)
		{
			$table->increments('errorid');
			$table->integer('moduloid')->unsigned()->index('logerrores_moduloid_foreign');
			$table->integer('permisoid')->unsigned()->index('logerrores_permisoid_foreign');
			$table->integer('usuarioid')->unsigned()->index('logerrores_usuarioid_foreign');
			$table->dateTime('fechaerror');
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
		Schema::drop('logerrores');
	}

}
