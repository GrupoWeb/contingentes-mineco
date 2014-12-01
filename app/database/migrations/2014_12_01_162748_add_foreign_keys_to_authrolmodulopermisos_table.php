<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAuthrolmodulopermisosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('authrolmodulopermisos', function(Blueprint $table)
		{
			$table->foreign('modulopermisoid')->references('modulopermisoid')->on('authmodulopermisos')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('rolid')->references('rolid')->on('authroles')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('authrolmodulopermisos', function(Blueprint $table)
		{
			$table->dropForeign('authrolmodulopermisos_modulopermisoid_foreign');
			$table->dropForeign('authrolmodulopermisos_rolid_foreign');
		});
	}

}
