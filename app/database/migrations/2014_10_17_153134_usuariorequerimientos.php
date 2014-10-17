<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Usuariorequerimientos extends Migration {

	public function up(){
		Schema::create('usuariorequerimientos', function(Blueprint $t) {
			$t->increments('usuariorequerimientoid');
			$t->integer('usuarioid')->unsigned()->index('usuarioid');
			$t->integer('requerimientoid')->unsigned()->index('requerimientoid');
			$t->string('archivo', 200);
			$t->timestamps();
		});

		Schema::table('usuariorequerimientos', function(Blueprint $t) {
			$t->foreign('usuarioid')->references('usuarioid')->on('authusuarios')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$t->foreign('requerimientoid')->references('requerimientoid')->on('requerimientos')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}

	public function down(){
		Schema::table('usuariorequerimientos', function(Blueprint $table) {
			$table->dropForeign('usuariorequerimientos_usuarioid_foreign');
			$table->dropForeign('usuariorequerimientos_requerimientoid_foreign');
		});
		Schema::drop('usuariorequerimientos');
	}

}
