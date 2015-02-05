<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationPaisidTablaTratados extends Migration {

	public function up() {
		Schema::table('tratados', function(Blueprint $table) {
			$table->dropColumn('paisprocedencia');
			$table->integer('paisid')->unsigned()->nullable()->after('textocertificado');
			$table->foreign('paisid')->references('paisid')->on('paises')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}

	public function down() {
		Schema::table('tratados', function(Blueprint $table) {
			$table->dropForeign('tratados_paisid_foreign');
			$table->dropColumn('paisid');
			$table->string('paisprocedencia')->after('textocertificado');
		});
	}

}
