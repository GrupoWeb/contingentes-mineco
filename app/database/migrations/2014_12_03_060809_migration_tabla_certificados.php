<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationTablaCertificados extends Migration {

	public function up() {
		Schema::create('certificados', function(Blueprint $table) {
			$table->increments('certificadoid');
			$table->integer('usuarioid')->unsigned();
			$table->integer('correlativo')->unsigned();
			$table->string('tratado')->nullable();
			$table->string('nombre')->nullable();
			$table->string('direccion')->nullable();
			$table->string('nit')->nullable();
			$table->string('telefono')->nullable();
			$table->string('volumen')->nullable();
			$table->string('volumenletras')->nullable();
			$table->string('fraccion')->nullable();
			$table->string('paisprocedencia')->nullable();
			$table->text('tratadodescripcion')->nullable();
			$table->datetime('fecha');
			$table->datetime('fechavencimiento');
			$table->timestamps();

			$table->foreign('usuarioid')->references('usuarioid')->on('authusuarios')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});

		Schema::table('movimientos', function(Blueprint $table) {
			$table->integer('certificadoid')->unsigned()->nullable()->after('usuarioid');
			$table->foreign('certificadoid')->references('certificadoid')->on('certificados')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}

	public function down() {
		Schema::table('movimientos', function(Blueprint $table) {
			$table->dropForeign('movimientos_certificadoid_foreign');
			$table->dropColumn('certificadoid');
		});
		Schema::drop('certificados');
	}

}
