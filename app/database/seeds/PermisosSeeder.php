<?php
	class PermisosSeeder extends Seeder {
		public function run(){
			DB::statement('SET FOREIGN_KEY_CHECKS=0');
			DB::table('authpermisos')->truncate();

			DB::table('authpermisos')->insert(array(
				'permisoid'      => 1,
				'nombre'         => 'index',
				'nombrefriendly' => 'Ver',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authpermisos')->insert(array(
				'permisoid'      => 2,
				'nombre'         => 'create',
				'nombrefriendly' => 'Crear',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authpermisos')->insert(array(
				'permisoid'      => 3,
				'nombre'         => 'store',
				'nombrefriendly' => 'Guardar',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authpermisos')->insert(array(
				'permisoid'      => 4,
				'nombre'         => 'edit',
				'nombrefriendly' => 'Editar',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authpermisos')->insert(array(
				'permisoid'      => 5,
				'nombre'         => 'update',
				'nombrefriendly' => 'Actualizar',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authpermisos')->insert(array(
				'permisoid'      => 6,
				'nombre'         => 'destroy',
				'nombrefriendly' => 'Borrar',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authpermisos')->insert(array(
				'permisoid'      => 7,
				'nombre'         => 'show',
				'nombrefriendly' => 'Mostrar datos',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		  
		  DB::table('authpermisos')->insert(array(
				'permisoid'      => 11,
				'nombre'         => 'generar',
				'nombrefriendly' => 'Generar',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));

			DB::table('authpermisos')->insert(array(
				'permisoid'      => 12,
				'nombre'         => 'anular',
				'nombrefriendly' => 'Anular',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));

			DB::table('authpermisos')->insert(array(
				'permisoid'      => 13,
				'nombre'         => 'liquidar',
				'nombrefriendly' => 'Liquidar',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));

			DB::table('authpermisos')->insert(array(
				'permisoid'      => 14,
				'nombre'         => 'procesarliquidacion',
				'nombrefriendly' => 'Procesar liquidación',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		  

            DB::table('authpermisos')->insert(array(
                'permisoid'      => 15,
                'nombre'         => 'perfil',
                'nombrefriendly' => 'Perfil de usuarios',
                'created_at'     => date_create(), 'updated_at' => date_create()
			));
		  

		  DB::statement('SET FOREIGN_KEY_CHECKS=1');
		}
	}