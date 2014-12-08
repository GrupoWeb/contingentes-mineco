<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationColumnasAdicionalesInscripcionUsuario extends Migration {

	public function up() {
		Schema::table('authusuarios', function(Blueprint $table) {
			$table->string('nit')->nullable()->after('nombrecompleto');
			$table->string('razonsocial')->nullable()->after('nit');
			$table->string('propietario')->nullable()->after('razonsocial');
			$table->string('domiciliofiscal')->nullable()->after('propietario');
			$table->string('domiciliocomercial')->nullable()->after('domiciliofiscal');
			$table->string('direccionnotificaciones')->nullable()->after('domiciliocomercial');
			$table->string('telefono')->nullable()->after('direccionnotificaciones');
			$table->string('fax')->nullable()->after('telefono');
			$table->string('encargadoimportaciones')->nullable()->after('fax');
		});
	}

	public function down() {
		Schema::table('authusuarios', function(Blueprint $table){
			$table->dropColumn('nit');
			$table->dropColumn('razonsocial');
			$table->dropColumn('propietario');
			$table->dropColumn('domiciliofiscal');
			$table->dropColumn('domiciliocomercial');
			$table->dropColumn('direccionnotificaciones');
			$table->dropColumn('telefono');
			$table->dropColumn('fax');
			$table->dropColumn('encargadoimportaciones');
		});
	}

}
