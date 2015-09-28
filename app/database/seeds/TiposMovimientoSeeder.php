<?php
	class TiposMovimientoSeeder extends Seeder {
		public function run(){
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

			DB::table('tiposmovimiento')->insert(array(
				'tipomovimientoid'  => 5,
				'nombre'            => 'Devoluciones'
			));
		
			DB::table('tiposmovimiento')->update(array('created_at'=>date_create(), 'updated_at'=>date_create()));
		  DB::statement('SET FOREIGN_KEY_CHECKS=1');
		}
	}