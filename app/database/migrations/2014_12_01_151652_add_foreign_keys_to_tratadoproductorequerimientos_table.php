<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTratadoproductorequerimientosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tratadoproductorequerimientos', function(Blueprint $table)
		{
			$table->foreign('tratadoproductoid', 'tratadoproductorequerimientos_ibfk_3')->references('tratadoproductoid')->on('tratadosproductos')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('requerimientoid', 'tratadoproductorequerimientos_ibfk_2')->references('requerimientoid')->on('requerimientos')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tratadoproductorequerimientos', function(Blueprint $table)
		{
			$table->dropForeign('tratadoproductoid');
			$table->dropForeign('requerimientoid');
		});
	}

}
