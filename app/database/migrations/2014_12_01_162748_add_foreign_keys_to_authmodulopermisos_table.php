<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAuthmodulopermisosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('authmodulopermisos', function(Blueprint $table)
		{
			$table->foreign('moduloid')->references('moduloid')->on('authmodulos')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('permisoid')->references('permisoid')->on('authpermisos')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('authmodulopermisos', function(Blueprint $table)
		{
			$table->dropForeign('authmodulopermisos_moduloid_foreign');
			$table->dropForeign('authmodulopermisos_permisoid_foreign');
		});
	}

}
