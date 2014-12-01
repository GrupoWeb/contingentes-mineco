<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuthmenuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('authmenu', function(Blueprint $table)
		{
			$table->increments('menuid');
			$table->integer('padreid')->unsigned()->nullable()->index('authmenu_padreid_foreign');
			$table->string('nombre', 50);
			$table->integer('modulopermisoid')->unsigned()->nullable()->index('authmenu_modulopermisoid_foreign');
			$table->integer('orden')->unsigned();
			$table->string('icono', 50)->nullable();
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
		Schema::drop('authmenu');
	}

}
