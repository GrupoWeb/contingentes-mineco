<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationCertificadoProducto extends Migration {

	public function up() {
		Schema::table('certificados', function($table){
			$table->string('producto')->after('tratado')->nullable();
		});
	}

	public function down() {
		Schema::table('certificados', function($table){
			$table->dropColumn('producto');
		});
	}

}
