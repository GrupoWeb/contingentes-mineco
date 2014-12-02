<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationColumnaUnidadesProductos extends Migration {

	public function up() {
		Schema::table('productos', function(Blueprint $table) {
			$table->integer('unidadmedidaid')->unsigned()->default(1)->after('nombre');
			$table->foreign('unidadmedidaid')->references('unidadmedidaid')->on('unidadesmedida')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}

	public function down() {
		Schema::table('productos', function(Blueprint $table){
			$table->dropForeign('productos_unidadmedidaid_foreign');
			$table->dropColumn('unidadmedidaid');
		});
	}

}
