<?php
	class MenuSeeder extends Seeder {
		public function run(){
			DB::statement('SET FOREIGN_KEY_CHECKS=0');
			DB::table('authmenu')->truncate();

			DB::table('authmenu')->insert(array(
				'menuid'					=> 1,
				'padreid'        	=> null,
				'modulopermisoid' => '1',
				'nombre'         	=> 'Inicio',
				'orden' 					=> 1000,
				'icono'         	=> null,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmenu')->insert(array(
				'menuid'					=> 2,
				'padreid'        	=> null,
				'modulopermisoid' => null,
				'nombre'         	=> 'Catálogos',
				'orden' 					=> 2000,
				'icono'         	=> null,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmenu')->insert(array(
				'menuid'					=> 3,
				'padreid'        	=> '2',
				'modulopermisoid' => '22',
				'nombre'         	=> 'Productos',
				'orden' 					=> 100,
				'icono'         	=> null,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmenu')->insert(array(
				'menuid'					=> 4,
				'padreid'        	=> '2',
				'modulopermisoid' => '29',
				'nombre'         	=> 'Requerimientos',
				'orden' 					=> 200,
				'icono'         	=> null,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmenu')->insert(array(
				'menuid'					=> 5,
				'padreid'        	=> '2',
				'modulopermisoid' => '36',
				'nombre'         	=> 'Tratados',
				'orden' 					=> 300,
				'icono'         	=> null,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmenu')->insert(array(
				'menuid'					=> 6,
				'padreid'        	=> '2',
				'modulopermisoid' => '43',
				'nombre'         	=> 'Periodos',
				'orden' 					=> 400,
				'icono'         	=> null,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 7,
				'padreid'        	=> 2,
				'modulopermisoid' => 51,
				'nombre'         	=> 'Solicitudes Pendientes',
				'orden' 					=> 500,
				'icono'         	=> null,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

		  		DB::statement('SET FOREIGN_KEY_CHECKS=1');
		}
	}