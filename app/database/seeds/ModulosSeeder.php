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
				'nombrefriendly' => 'Usuarios',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulos')->insert(array(
				'moduloid'       => 3,
				'nombre'         => 'roles',
				'nombrefriendly' => 'Roles',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulos')->insert(array(
				'moduloid'       => 4,
				'nombre'         => 'contingentes',
				'nombrefriendly' => 'Catálogo de Contingentes',
				'descripcion'    => 'Catalogo de Contingentes',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulos')->insert(array(
				'moduloid'       => 5,
				'nombre'         => 'requerimientos',
				'nombrefriendly' => 'Catálogo de Requerimientos',
				'descripcion'    => 'Catálogo de Requerimientos',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulos')->insert(array(
				'moduloid'       => 6,
				'nombre'         => 'tratados',
				'nombrefriendly' => 'Catálogo de Tratados',
				'descripcion'    => 'Catálogo de Tratados',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulos')->insert(array(
				'moduloid'       => 7,
				'nombre'         => 'periodos',
				'nombrefriendly' => 'Catálogo de periodos',
				'descripcion'    => 'Catálogo de periodos',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulos')->insert(array(
				'moduloid'       => 8,
				'nombre'         => 'movimientos',
				'nombrefriendly' => 'Catálogo de movimientos',
				'descripcion'    => 'Catálogo de movimientos',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulos')->insert(array(
				'moduloid'       => 9,
				'nombre'         => 'solicitudespendientes.asignacion',
				'nombrefriendly' => 'Solicitudes asignación',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulos')->insert(array(
				'moduloid'       => 10,
				'nombre'         => 'solicitudespendientes.inscripcion',
				'nombrefriendly' => 'Solicitudes inscripción',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulos')->insert(array(
				'moduloid'       => 11,
				'nombre'         => 'certificados',
				'nombrefriendly' => 'Certificados',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulos')->insert(array(
				'moduloid'       => 12,
				'nombre'         => 'solicitud.emision',
				'nombrefriendly' => 'Solicitud de emisión',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulos')->insert(array(
				'moduloid'       => 13,
				'nombre'         => 'contingente.requerimientos',
				'nombrefriendly' => 'Asignación de requerimientos a contingentes',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));

		  DB::statement('SET FOREIGN_KEY_CHECKS=1');
		}
	}
//Termina ModulosSeeder.php