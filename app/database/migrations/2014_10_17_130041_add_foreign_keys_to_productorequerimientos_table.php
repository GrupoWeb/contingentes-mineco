<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProductorequerimientosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('productorequerimientos', function(Blueprint $table)
		{
			$table->foreign('productoid', 'productorequerimientos_ibfk_1')->references('productoid')->on('productos')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('requerimientoid', 'productorequerimientos_ibfk_2')->references('requerimientoid')->on('requerimientos')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('productorequerimientos', function(Blueprint $table)
		{
			$table->dropForeign('productoid');
			$table->dropForeign('requerimientoid');
		});
	}

}
