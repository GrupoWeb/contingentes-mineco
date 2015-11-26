<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationValorDefaultRealCertificados extends Migration {

	public function up() {
		DB::unprepared('ALTER TABLE certificados CHANGE `real` `real` DECIMAL(20,5)  NOT NULL  DEFAULT "0"');
	}

	public function down() {
		DB::unprepared('ALTER TABLE certificados CHANGE `real` `real` DECIMAL(20,5)  NOT NULL  DEFAULT "0"');
	}
}