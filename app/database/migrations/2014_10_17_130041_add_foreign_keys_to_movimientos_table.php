<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMovimientosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('movimientos', function(Blueprint $table)
		{
			$table->foreign('usuarioid', 'movimientos_ibfk_2')->references('usuarioid')->on('authusuarios')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('periodoid', 'movimientos_ibfk_1')->references('periodoid')->on('periodos')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('movimientos', function(Blueprint $table)
		{
			$table->dropForeign('usuarioid');
			$table->dropForeign('periodoid');
		});
	}

}
