<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationTipoIdMovimientos extends Migration {

	public function up() {
		Schema::create('tiposmovimiento', function($table){
			$table->increments('tipomovimientoid');
			$table->string('nombre');
			$table->timestamps();
		});

		Schema::table('movimientos', function($table){
			$table->integer('tipomovimientoid')->unsigned()->nullable()->after('certificadoid');
			$table->foreign('tipomovimientoid')->references('tipomovimientoid')->on('tiposmovimiento')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('movimientos', function($table) {
			$table->dropForeign('movimientos_tipomovimientoid_foreign');
			$table->dropColumn('tipomovimientoid');
		});

		Schema::drop('tiposmovimiento');
	}

}
