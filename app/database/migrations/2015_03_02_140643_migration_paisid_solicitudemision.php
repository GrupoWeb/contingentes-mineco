<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationPaisidSolicitudemision extends Migration {

	public function up() {
		Schema::table('solicitudesemision', function(Blueprint $table) {
			$table->integer('paisid')->unsigned()->nullable()->after('periodoid');
			$table->foreign('paisid')->references('paisid')->on('paises')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}

	public function down() {
		Schema::table('solicitudesemision', function(Blueprint $table) {
			$table->dropForeign('solicitudesemision_paisid_foreign');
			$table->dropColumn('paisid');
		});
	}

}
