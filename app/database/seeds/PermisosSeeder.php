<?php
	class PermisosSeeder extends Seeder {
		public function run(){
			DB::statement('SET FOREIGN_KEY_CHECKS=0');
			DB::table('authpermisos')->truncate();

			DB::table('authpermisos')->insert(array(
				'permisoid'      => 1,
				'nombre'         => 'index',
				'nombrefriendly' => 'Ver'
			));
		
			DB::table('authpermisos')->insert(array(
				'permisoid'      => 2,
				'nombre'         => 'create',
				'nombrefriendly' => 'Crear'
			));
		
			DB::table('authpermisos')->insert(array(
				'permisoid'      => 3,
				'nombre'         => 'store',
				'nombrefriendly' => 'Guardar'
			));
		
			DB::table('authpermisos')->insert(array(
				'permisoid'      => 4,
				'nombre'         => 'edit',
				'nombrefriendly' => 'Editar'
			));
		
			DB::table('authpermisos')->insert(array(
				'permisoid'      => 5,
				'nombre'         => 'update',
				'nombrefriendly' => 'Actualizar'
			));
		
			DB::table('authpermisos')->insert(array(
				'permisoid'      => 6,
				'nombre'         => 'destroy',
				'nombrefriendly' => 'Borrar'
			));
		
			DB::table('authpermisos')->insert(array(
				'permisoid'      => 7,
				'nombre'         => 'show',
				'nombrefriendly' => 'Mostrar datos'
			));
		  
		  DB::table('authpermisos')->insert(array(
				'permisoid'      => 11,
				'nombre'         => 'generar',
				'nombrefriendly' => 'Generar'
			));

			DB::table('authpermisos')->insert(array(
				'permisoid'      => 12,
				'nombre'         => 'anular',
				'nombrefriendly' => 'Anular'
			));

			DB::table('authpermisos')->insert(array(
				'permisoid'      => 13,
				'nombre'         => 'liquidar',
				'nombrefriendly' => 'Liquidar'
			));

			DB::table('authpermisos')->insert(array(
				'permisoid'      => 14,
				'nombre'         => 'procesarliquidacion',
				'nombrefriendly' => 'Procesar liquidación'
			));
		  

	    DB::table('authpermisos')->insert(array(
	        'permisoid'      => 15,
	        'nombre'         => 'perfil',
	        'nombrefriendly' => 'Perfil de usuarios'
			));

			DB::table('authpermisos')->insert(array(
	        'permisoid'      => 16,
	        'nombre'         => 'procesaranulacion',
	        'nombrefriendly' => 'Procesar anulación'
			));
		  
			DB::table('authpermisos')->update(array('created_at'=>date_create(), 'updated_at'=>date_create()));
		  DB::statement('SET FOREIGN_KEY_CHECKS=1');
		}
	}