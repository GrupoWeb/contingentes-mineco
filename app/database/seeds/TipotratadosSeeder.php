<?php
	class TipotratadosSeeder extends Seeder {
		public function run(){
			DB::statement('SET FOREIGN_KEY_CHECKS=0');
			DB::table('tipotratados')->truncate();

			DB::table('tipotratados')->insert(array(
				'tipotratadoid'  => 1,
				'nombre'         => 'Primero en tiempo, primero en derecho',
				'nombrecorto'    => 'PTPD',
				'asignacion'     => 0
			));
		
			DB::table('tipotratados')->insert(array(
				'tipotratadoid'  => 2,
				'nombre'         => 'Cuenta corriente',
				'nombrecorto'    => 'CC',
				'asignacion'     => 1
			));

			DB::table('tipotratados')->update(array('created_at'=>date_create(), 'updated_at'=>date_create()));
		  DB::statement('SET FOREIGN_KEY_CHECKS=1');
		}
	}