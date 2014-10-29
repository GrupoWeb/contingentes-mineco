<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarFirmaYCertificadoAUsuario extends Migration {

	public function up() {
		Schema::table('authusuarios', function($t) {
    	$t->binary('firma')->nullable()->after('nombre');
    	$t->text('certificado')->nullable()->after('firma');
		});
	}

	public function down() {
		Schema::table('authusuarios', function($t) {
    	$t->dropColumn('firma');
    	$t->dropColumn('certificado');
		});
	}

}
