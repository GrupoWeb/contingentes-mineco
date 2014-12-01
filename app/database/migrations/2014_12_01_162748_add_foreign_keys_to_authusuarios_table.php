<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAuthusuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('authusuarios', function(Blueprint $table)
		{
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
		Schema::table('authusuarios', function(Blueprint $table)
		{
			$table->dropForeign('authusuarios_rolid_foreign');
		});
	}

}
