<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationPaisidCertificado extends Migration {

	public function up() {
		Schema::table('certificados', function(Blueprint $table) {
			$table->dropColumn('paisprocedencia');
			$table->integer('paisid')->unsigned()->nullable()->after('usuarioid');
			$table->foreign('paisid')->references('paisid')->on('paises')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}

	public function down() {
		Schema::table('certificados', function(Blueprint $table) {
			$table->dropForeign('certificados_paisid_foreign');
			$table->dropColumn('paisid');
			$table->string('paisprocedencia')->nullable()->after('fraccion');
		});
	}

}
