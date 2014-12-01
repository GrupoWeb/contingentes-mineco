<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToContingentesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contingentes', function(Blueprint $table)
		{
			$table->foreign('productoid', 'contingentes_ibfk_2')->references('productoid')->on('productos')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('tratadoid', 'contingentes_ibfk_1')->references('tratadoid')->on('tratados')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contingentes', function(Blueprint $table)
		{
			$table->dropForeign('productoid');
			$table->dropForeign('tratadoid');
		});
	}

}
