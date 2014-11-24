<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationRequerimientosEnum extends Migration {

	public function up() {
		DB::unprepared("ALTER TABLE `contingentes`.`productorequerimientos` 
			CHANGE `tipo` `tipo` ENUM('inscripcion','asignacion','emision') 
			DEFAULT 'inscripcion' NOT NULL"); 
	}

	public function down() {
		DB::unprepared("ALTER TABLE `contingentes`.`productorequerimientos` 
			CHANGE `tipo` `tipo` ENUM('Inscripción','Asignación','Emisión') 
			DEFAULT 'Inscripción' NOT NULL"); 
	}

}
