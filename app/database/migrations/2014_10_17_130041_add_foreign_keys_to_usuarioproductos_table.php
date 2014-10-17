<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUsuarioproductosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('usuarioproductos', function(Blueprint $table)
		{
			$table->foreign('usuarioid', 'usuarioproductos_ibfk_1')->references('usuarioid')->on('authusuarios')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('productoid', 'usuarioproductos_ibfk_2')->references('productoid')->on('productos')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('usuarioproductos', function(Blueprint $table)
		{
			$table->dropForeign('usuarioid');
			$table->dropForeign('productoid');
		});
	}

}
