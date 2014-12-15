<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActivoUsuariocontingentes extends Migration {

	public function up()
	{
		Schema::table('usuariocontingentes', function(Blueprint $table) {
			$table->boolean('activo')->default(0);
			$table->timestamps();
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('usuariocontingentes', function(Blueprint $table) {
			$table->dropColumn('activo');
			$table->dropColumn('created_at');
			$table->dropColumn('updated_at');
		});
	}

}
