<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUsuariorequerimientosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('usuariorequerimientos', function(Blueprint $table)
		{
			$table->foreign('requerimientoid')->references('requerimientoid')->on('requerimientos')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('usuarioid')->references('usuarioid')->on('authusuarios')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('usuariorequerimientos', function(Blueprint $table)
		{
			$table->dropForeign('usuariorequerimientos_requerimientoid_foreign');
			$table->dropForeign('usuariorequerimientos_usuarioid_foreign');
		});
	}

}
