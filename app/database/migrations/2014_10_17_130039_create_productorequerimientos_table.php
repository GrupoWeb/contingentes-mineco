<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductorequerimientosTable extends Migration {

	public function up() {
		Schema::create('productorequerimientos', function(Blueprint $table) {
			$table->increments('priid');
			$table->integer('productoid')->unsigned()->index('productorequerimientos_ibfk_1');
			$table->integer('requerimientoid')->unsigned()->index('requerimientoid');
			$table->enum('tipo', array('inscripcion','asignacion','emision'))->default('inscripcion');
		});
	}

	public function down() {
		Schema::drop('productorequerimientos');
	}
}
