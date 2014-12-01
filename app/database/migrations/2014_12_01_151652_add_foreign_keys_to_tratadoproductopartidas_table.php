<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTratadoproductopartidasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tratadoproductopartidas', function(Blueprint $table)
		{
			$table->foreign('tratadoproductoid', 'tratadoproductopartidas_ibfk_1')->references('tratadoproductoid')->on('tratadosproductos')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tratadoproductopartidas', function(Blueprint $table)
		{
			$table->dropForeign('tratadoproductoid');
		});
	}

}
