<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUsuariotratadoproductosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('usuariotratadoproductos', function(Blueprint $table)
		{
			$table->foreign('tratadoproductoid', 'usuariotratadoproductos_ibfk_2')->references('tratadoproductoid')->on('tratadosproductos')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('usuarioid', 'usuariotratadoproductos_ibfk_1')->references('usuarioid')->on('authusuarios')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('usuariotratadoproductos', function(Blueprint $table)
		{
			$table->dropForeign('tratadoproductoid');
			$table->dropForeign('usuarioid');
		});
	}

}
