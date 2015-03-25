<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationMigrarEnumTipoMovimientoAFk extends Migration {

	public function up() {
		//=== se seedea la tabla de tipos de movimiento por si no tiene datos
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('tiposmovimiento')->truncate();
		DB::table('tiposmovimiento')->insert(array(
			'tipomovimientoid'  => 1,
			'nombre'            => 'Cuota'
		));
		DB::table('tiposmovimiento')->insert(array(
			'tipomovimientoid'  => 2,
			'nombre'            => 'Certificado'
		));
		DB::table('tiposmovimiento')->insert(array(
			'tipomovimientoid'  => 3,
			'nombre'            => 'Asignación'
		));
		DB::table('tiposmovimiento')->insert(array(
			'tipomovimientoid'  => 4,
			'nombre'            => 'Penalizaciones'
		));
		DB::table('tiposmovimiento')->update(array('created_at'=>date_create(), 'updated_at'=>date_create()));
	  DB::statement('SET FOREIGN_KEY_CHECKS=1');

	  //=== migrar la columna de enum a fk
	  DB::statement('UPDATE movimientos AS m SET tipomovimientoid = (SELECT tipomovimientoid FROM tiposmovimiento AS tm WHERE tm.nombre = m.tipo)');
	}

	public function down() {
		DB::statement('UPDATE movimientos SET tipomovimientoid = NULL');
	}

}
