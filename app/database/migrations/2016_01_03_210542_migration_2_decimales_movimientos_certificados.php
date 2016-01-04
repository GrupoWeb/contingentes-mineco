<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Migration2DecimalesMovimientosCertificados extends Migration {

	public function up() {		
		//certificados
		DB::statement(DB::raw('ALTER TABLE certificados CHANGE volumen volumen DECIMAL(20,2)'));
		DB::statement(DB::raw('ALTER TABLE certificados CHANGE `real` `real` DECIMAL(20,2)'));
		//cantidad
		DB::statement(DB::raw('ALTER TABLE movimientos CHANGE cantidad cantidad DECIMAL(20,2)'));
	}

	public function down() {
		//certificados
		DB::statement(DB::raw('ALTER TABLE certificados CHANGE volumen volumen DECIMAL(20,5)'));
		DB::statement(DB::raw('ALTER TABLE certificados CHANGE `real` `real` DECIMAL(20,5)'));
		//movimientos
		DB::statement(DB::raw('ALTER TABLE movimientos CHANGE cantidad cantidad DECIMAL(20,5)'));
	}

}
