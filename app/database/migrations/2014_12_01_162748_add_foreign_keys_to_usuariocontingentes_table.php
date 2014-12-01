<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUsuariocontingentesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('usuariocontingentes', function(Blueprint $table)
		{
			$table->foreign('contingenteid', 'usuariocontingentes_ibfk_2')->references('contingenteid')->on('contingentes')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('usuarioid', 'usuariocontingentes_ibfk_1')->references('usuarioid')->on('authusuarios')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('usuariocontingentes', function(Blueprint $table)
		{
			$table->dropForeign('contingenteid');
			$table->dropForeign('usuarioid');
		});
	}

}
