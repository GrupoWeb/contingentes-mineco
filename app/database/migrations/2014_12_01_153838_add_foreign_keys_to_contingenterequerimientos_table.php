<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToContingenterequerimientosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contingenterequerimientos', function(Blueprint $table)
		{
			$table->foreign('contingenteid', 'contingenterequerimientos_ibfk_3')->references('contingenteid')->on('contingentes')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('requerimientoid', 'contingenterequerimientos_ibfk_2')->references('requerimientoid')->on('requerimientos')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contingenterequerimientos', function(Blueprint $table)
		{
			$table->dropForeign('contingenteid');
			$table->dropForeign('requerimientoid');
		});
	}

}
