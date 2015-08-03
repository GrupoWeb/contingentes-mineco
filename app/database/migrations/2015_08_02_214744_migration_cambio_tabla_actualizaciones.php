<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationCambioTablaActualizaciones extends Migration {

	public function up() {
		Schema::table('solicitudactualizacion', function($table) {
			$table->integer('empresaid')->unsigned()->after('actualizacionid');
			$table->text('observaciones')->after('estado');
			$table->dropColumn('nit');
			$table->dropColumn('razonsocial');

			$table->foreign('empresaid')->references('empresaid')->on('empresas');
		});
	}

	public function down() {
		Schema::table('solicitudactualizacion', function($table) {
			$table->dropForeign('solicitudactualizacion_empresaid_foreign');
			$table->dropColumn('empresaid');
			$table->dropColumn('observaciones');

			$table->string('nit');
			$table->string('razonsocial');
		});
	}

}
