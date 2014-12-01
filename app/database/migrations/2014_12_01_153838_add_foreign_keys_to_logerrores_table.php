<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLogerroresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('logerrores', function(Blueprint $table)
		{
			$table->foreign('moduloid')->references('moduloid')->on('authmodulos')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('permisoid')->references('permisoid')->on('authpermisos')->onUpdate('CASCADE')->onDelete('RESTRICT');
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
		Schema::table('logerrores', function(Blueprint $table)
		{
			$table->dropForeign('logerrores_moduloid_foreign');
			$table->dropForeign('logerrores_permisoid_foreign');
			$table->dropForeign('logerrores_usuarioid_foreign');
		});
	}

}
