<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationCreatedbyMovimientos extends Migration {

	public function up() {
		Schema::table('movimientos', function(Blueprint $table) {
			$table->integer('created_by')->unsigned()->after('comentario');
			$table->foreign('created_by')->references('usuarioid')->on('authusuarios')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}

	public function down() {
		Schema::table('movimientos', function(Blueprint $table) {
			$table->dropForeign('movimientos_created_by_foreign');
			$table->dropColumn('created_by');
		});	
	}
}
