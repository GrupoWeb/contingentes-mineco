<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProductopartidasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('productopartidas', function(Blueprint $table)
		{
			$table->foreign('productoid', 'productopartidas_ibfk_1')->references('productoid')->on('productos')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('productopartidas', function(Blueprint $table)
		{
			$table->dropForeign('productoid');
		});
	}

}
