<?php
	class TipotratadosSeeder extends Seeder {
		public function run(){
			DB::statement('SET FOREIGN_KEY_CHECKS=0');
			DB::table('tipotratados')->truncate();

			DB::table('tipotratados')->insert(array(
				'tipotratadoid'  => 1,
				'nombre'         => 'Primero en tiempo, primero en derecho',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('tipotratados')->insert(array(
				'tipotratadoid'       => 2,
				'nombre'         => 'Cuota',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));

		  DB::statement('SET FOREIGN_KEY_CHECKS=1');
		}
	}