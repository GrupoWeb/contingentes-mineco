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
				'icono'         	=> null
			));
		
			DB::table('authmenu')->insert(array(
				'menuid'					=> 2,
				'padreid'        	=> null,
				'modulopermisoid' => null,
				'nombre'         	=> 'Catálogos',
				'orden' 					=> 2000,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 3,
				'padreid'        	=> 2,
				'modulopermisoid' => 50,
				'nombre'         	=> 'Productos',
				'orden' 					=> 100,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 4,
				'padreid'        	=> 2,
				'modulopermisoid' => 36,
				'nombre'         	=> 'Tratados & contingentes',
				'orden' 					=> 300,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 5,
				'padreid'        	=> 2,
				'modulopermisoid' => 29,
				'nombre'         	=> 'Requerimientos',
				'orden' 					=> 200,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 7,
				'padreid'        	=> 2,
				'modulopermisoid' => 43,
				'nombre'         	=> 'Períodos & cuotas',
				'orden' 					=> 500,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 9,
				'padreid'        	=> null,
				'modulopermisoid' => null,
				'nombre'         	=> 'Solicitudes',
				'orden' 					=> 2000,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 11,
				'padreid'        	=> null,
				'modulopermisoid' => null,
				'nombre'         	=> 'Admin',
				'orden' 					=> 4000,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 12,
				'padreid'        	=> 11,
				'modulopermisoid' => 2,
				'nombre'         	=> 'Usuarios DACE',
				'orden' 					=> 100,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 13,
				'padreid'        	=> 11,
				'modulopermisoid' => 9,
				'nombre'         	=> 'Roles',
				'orden' 					=> 200,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 14,
				'padreid'        	=> 9,
				'modulopermisoid' => 70,
				'nombre'         	=> 'Asignación',
				'orden' 					=> 100,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 15,
				'padreid'        	=> 9,
				'modulopermisoid' => 62,
				'nombre'         	=> 'Emisión',
				'orden' 					=> 200,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 16,
				'padreid'        	=> 9,
				'modulopermisoid' => null,
				'nombre'         	=> 'Pendientes',
				'orden' 					=> 300,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 17,
				'padreid'        	=> 16,
				'modulopermisoid' => 65,
				'nombre'         	=> 'Inscripción',
				'orden' 					=> 10,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 18,
				'padreid'        	=> 16,
				'modulopermisoid' => 51,
				'nombre'         	=> 'Asignación',
				'orden' 					=> 20,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 19,
				'padreid'        	=> 16,
				'modulopermisoid' => 72,
				'nombre'         	=> 'Emisión',
				'orden' 					=> 30,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 20,
				'padreid'        	=> null,
				'modulopermisoid' => 79,
				'nombre'         	=> 'Certificados',
				'orden' 					=> 3000,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 21,
				'padreid'        	=> null,
				'modulopermisoid' => null,
				'nombre'         	=> 'Reportes',
				'orden' 					=> 3600,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 22,
				'padreid'        	=> 21,
				'modulopermisoid' => 90,
				'nombre'         	=> 'Cuenta corriente - Contingentes',
				'orden' 					=> 100,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 23,
				'padreid'        	=> 9,
				'modulopermisoid' => null,
				'nombre'         	=> 'Histórico',
				'orden' 					=> 400,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 25,
				'padreid'        	=> 2,
				'modulopermisoid' => 98,
				'nombre'         	=> 'Países',
				'orden' 					=> 50,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 26,
				'padreid'        	=> 9,
				'modulopermisoid' => 109,
				'nombre'         	=> 'Inscripción',
				'orden' 					=> 50,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 27,
				'padreid'        	=> 23,
				'modulopermisoid' => 92,
				'nombre'         	=> 'Inscripción',
				'orden' 					=> 10,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 28,
				'padreid'        	=> 23,
				'modulopermisoid' => 118,
				'nombre'         	=> 'Asignación',
				'orden' 					=> 20,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 29,
				'padreid'        	=> 23,
				'modulopermisoid' => 120,
				'nombre'         	=> 'Emisión',
				'orden' 					=> 30,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 30,
				'padreid'        	=> 11,
				'modulopermisoid' => 111,
				'nombre'         	=> 'Usuarios webservice',
				'orden' 					=> 300,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 31,
				'padreid'        	=> 2,
				'modulopermisoid' => 123,
				'nombre'         	=> 'Unidades de medida',
				'orden' 					=> 150,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 32,
				'padreid'        	=> 11,
				'modulopermisoid' => 131,
				'nombre'         	=> 'Empresas',
				'orden' 					=> 150,
				'icono'         	=> null
			));

			DB::table('authmenu')->insert(array(
				'menuid'					=> 33,
				'padreid'        	=> 21,
				'modulopermisoid' => 138,
				'nombre'         	=> 'Cuenta corriente - Empresas',
				'orden' 					=> 200,
				'icono'         	=> null
			));

			DB::table('authmenu')->update(array('created_at'=>date_create(), 'updated_at'=>date_create()));
		  DB::statement('SET FOREIGN_KEY_CHECKS=1');
		}
	}