<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePeriodosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('periodos', function(Blueprint $table)
		{
			$table->increments('periodoid');
			$table->integer('contingenteid')->unsigned()->index('productoid');
			$table->string('nombre', 200)->nullable();
			$table->date('fechainicio')->nullable();
			$table->date('fechafin')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('periodos');
	}

}
