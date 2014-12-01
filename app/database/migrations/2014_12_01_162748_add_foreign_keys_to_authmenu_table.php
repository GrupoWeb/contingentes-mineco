<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAuthmenuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('authmenu', function(Blueprint $table)
		{
			$table->foreign('modulopermisoid')->references('modulopermisoid')->on('authmodulopermisos')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('padreid')->references('menuid')->on('authmenu')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('authmenu', function(Blueprint $table)
		{
			$table->dropForeign('authmenu_modulopermisoid_foreign');
			$table->dropForeign('authmenu_padreid_foreign');
		});
	}

}
