<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationCambioTablaActualizaciones extends Migration {

	public function up() {
		Schema::table('solicitudactualizacion', function($table) {
			$table->dropForeign('solicitudactualizacion_usuarioid_foreign');
			$table->dropColumn('usuarioid');

			$table->integer('empresaid')->unsigned()->after('actualizacionid');
			$table->foreign('empresaid')->references('empresaid')->on('empresas');

			$table->dropColumn('nit');
			$table->dropColumn('razonsocial');
		});
	}

	public function down() {
		Schema::table('solicitudactualizacion', function($table) {
			$table->dropForeign('solicitudactualizacion_empresaid_foreign');
			$table->dropColumn('empresaid');

			$table->integer('usuarioid')->unsigned()->after('actualizacionid');
			$table->foreign('usuarioid')->references('usuarioid')->on('authusuarios');

			$table->string('nit');
			$table->string('razonsocial');
		});
	}

}
