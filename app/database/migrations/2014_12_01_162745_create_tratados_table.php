<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTratadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tratados', function(Blueprint $table)
		{
			$table->increments('tratadoid');
			$table->string('nombre', 200);
			$table->enum('tipo', array('Importación','Exportación'));
			$table->boolean('activo')->default(1);
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
		Schema::drop('tratados');
	}

}
