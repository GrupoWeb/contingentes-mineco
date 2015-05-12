<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationTipoCorrelativos extends Migration {

	public function up() {
		Schema::create('tiposcorrelativo', function($table){
			$table->increments('tipocorrelativoid');
			$table->string('nombre');
			$table->timestamps();
		});

		DB::statement(DB::raw('INSERT INTO tiposcorrelativo SET tipocorrelativoid=1, nombre="Correlativo", created_at=NOW(), updated_at=NOW()'));

		Schema::table('contingentes', function($table){
			$table->integer('tipocorrelativoid')->unsigned()->after('tipotratadoid')->default(1);
			$table->foreign('tipocorrelativoid')->references('tipocorrelativoid')->on('tiposcorrelativo');
		});

	}

	public function down() {
		Schema::table('contingentes', function($table){
			$table->dropForeign('contingentes_tipocorrelativoid_foreign');
			$table->dropColumn('tipocorrelativoid');
		});

		Schema::drop('tiposcorrelativo');
	}

}
