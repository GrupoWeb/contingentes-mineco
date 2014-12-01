<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPeriodosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('periodos', function(Blueprint $table)
		{
			$table->foreign('contingenteid', 'periodos_ibfk_1')->references('contingenteid')->on('contingentes')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('periodos', function(Blueprint $table)
		{
			$table->dropForeign('contingenteid');
		});
	}

}
