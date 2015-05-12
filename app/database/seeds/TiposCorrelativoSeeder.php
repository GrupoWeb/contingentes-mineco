<?php
	class TiposCorrelativoSeeder extends Seeder {
		public function run(){
			DB::statement('SET FOREIGN_KEY_CHECKS=0');
			DB::table('tiposcorrelativo')->truncate();

			DB::table('tiposcorrelativo')->insert(array(
				'tipocorrelativoid' => 1,
				'nombre'            => 'Correlativo'
			));
		
			DB::table('tiposcorrelativo')->insert(array(
				'tipocorrelativoid' => 2,
				'nombre'            => 'CA-AXXXXXX'
			));

			DB::table('tiposcorrelativo')->insert(array(
				'tipocorrelativoid' => 3,
				'nombre'            => 'CH-AXXXXXX'
			));


			DB::table('tiposcorrelativo')->update(array('created_at'=>date_create(), 'updated_at'=>date_create()));
		  DB::statement('SET FOREIGN_KEY_CHECKS=1');
		}
	}