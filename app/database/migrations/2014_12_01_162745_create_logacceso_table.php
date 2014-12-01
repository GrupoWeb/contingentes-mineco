<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogaccesoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logacceso', function(Blueprint $table)
		{
			$table->increments('accesoid');
			$table->integer('usuarioid')->unsigned()->index('logacceso_usuarioid_foreign');
			$table->string('sessionid');
			$table->string('ip', 15);
			$table->string('useragent');
			$table->dateTime('fechalogin');
			$table->dateTime('fechalogout');
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
		Schema::drop('logacceso');
	}

}
