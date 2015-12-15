<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationCantidadesADosDecimales extends Migration {
	
	public function up() {		
		//solicitudasignacion
		DB::statement(DB::raw('ALTER TABLE solicitudasignacion CHANGE asignado asignado DECIMAL(20,2) NULL DEFAULT NULL;'));
		DB::statement(DB::raw('ALTER TABLE solicitudasignacion CHANGE solicitado solicitado DECIMAL(20,2) NULL DEFAULT NULL;'));

		//solicitudesmision
		DB::statement(DB::raw('ALTER TABLE solicitudesemision CHANGE solicitado solicitado DECIMAL(20,2) NULL DEFAULT NULL;'));
		DB::statement(DB::raw('ALTER TABLE solicitudesemision CHANGE emitido emitido DECIMAL(20,2) NULL DEFAULT NULL;'));

	}

	public function down() {
		//solicitudasignacion
		DB::statement(DB::raw('ALTER TABLE solicitudasignacion CHANGE asignado asignado DECIMAL(20,5) NULL DEFAULT NULL;'));
		DB::statement(DB::raw('ALTER TABLE solicitudasignacion CHANGE solicitado solicitado DECIMAL(20,5) NULL DEFAULT NULL;'));

		//solicitudesmision
		DB::statement(DB::raw('ALTER TABLE solicitudesemision CHANGE solicitado solicitado DECIMAL(20,5) NULL DEFAULT NULL;'));
		DB::statement(DB::raw('ALTER TABLE solicitudesemision CHANGE emitido emitido DECIMAL(20,5) NULL DEFAULT NULL;'));
	}

}
