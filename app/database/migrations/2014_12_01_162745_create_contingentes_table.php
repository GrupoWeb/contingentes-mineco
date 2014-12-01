<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContingentesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contingentes', function(Blueprint $table)
		{
			$table->increments('contingenteid');
			$table->integer('tratadoid')->unsigned()->index('tratadoint');
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
		Schema::drop('contingentes');
	}

}
