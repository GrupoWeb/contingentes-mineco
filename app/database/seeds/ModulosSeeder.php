<?php
	class ModulosSeeder extends Seeder {
		public function run(){
			DB::statement('SET FOREIGN_KEY_CHECKS=0');
			DB::table('authmodulos')->truncate();

			DB::table('authmodulos')->insert(array(
				'moduloid'       => 1,
				'nombre'         => 'index',
				'nombrefriendly' => 'Inicio',
				'descripcion'    => 'Modulo de index',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulos')->insert(array(
				'moduloid'       => 2,
				'nombre'         => 'usuarios',
				'nombrefriendly' => 'Administración de usuarios',
				'descripcion'    => 'Modulo de usuarios',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulos')->insert(array(
				'moduloid'       => 3,
				'nombre'         => 'roles',
				'nombrefriendly' => 'Administración de roles',
				'descripcion'    => 'Modulo de roles',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulos')->insert(array(
				'moduloid'       => 4,
				'nombre'         => 'catalogos.productos',
				'nombrefriendly' => 'Catálogo de Productos',
				'descripcion'    => 'Catalogo de Productos',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulos')->insert(array(
				'moduloid'       => 5,
				'nombre'         => 'catalogos.requerimientos',
				'nombrefriendly' => 'Catálogo de Requerimientos',
				'descripcion'    => 'Catálogo de Requerimientos',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulos')->insert(array(
				'moduloid'       => 6,
				'nombre'         => 'catalogos.tratados',
				'nombrefriendly' => 'Catálogo de Tratados',
				'descripcion'    => 'Catálogo de Tratados',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulos')->insert(array(
				'moduloid'       => 7,
				'nombre'         => 'catalogos.periodos',
				'nombrefriendly' => 'Catálogo de periodos',
				'descripcion'    => 'Catálogo de periodos',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulos')->insert(array(
				'moduloid'       => 8,
				'nombre'         => 'catalogos.movimientos',
				'nombrefriendly' => 'Catálogo de movimientos',
				'descripcion'    => 'Catálogo de movimientos',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		  		DB::statement('SET FOREIGN_KEY_CHECKS=1');
		}
	}
//Termina ModulosSeeder.php