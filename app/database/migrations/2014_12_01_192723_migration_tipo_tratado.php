<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationTipoTratado extends Migration {

	public function up() {
		Schema::create('tipotratados', function(Blueprint $table) {
			$table->increments('tipotratadoid');
			$table->string('nombre', 255);
			$table->timestamps();
		});

		Schema::table('tratados', function(Blueprint $table) {
			$table->integer('tipotratadoid')->unsigned()->nullable()->after('tratadoid');
			$table->foreign('tipotratadoid')->references('tipotratadoid')->on('tipotratados')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}

	public function down() {
		Schema::table('tratados', function(Blueprint $table){
			$table->dropForeign('tratados_tipotratadoid_foreign');
			$table->dropColumn('tipotratadoid');
		});

		Schema::drop('tipotratados');
	}

}
