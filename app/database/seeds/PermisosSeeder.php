<?php
	class PermisosSeeder extends Seeder {
		public function run(){
			DB::statement('SET FOREIGN_KEY_CHECKS=0');
			DB::table('authpermisos')->truncate();

			DB::table('authpermisos')->insert(array(
				array(
					'permisoid'      => 1,
					'nombre'         => 'index',
					'nombrefriendly' => 'Ver'
				),
				array(
					'permisoid'      => 2,
					'nombre'         => 'create',
					'nombrefriendly' => 'Crear'
				),
				array(
					'permisoid'      => 3,
					'nombre'         => 'store',
					'nombrefriendly' => 'Guardar'
				),
				array(
					'permisoid'      => 4,
					'nombre'         => 'edit',
					'nombrefriendly' => 'Editar'
				),
				array(
					'permisoid'      => 5,
					'nombre'         => 'update',
					'nombrefriendly' => 'Actualizar'
				),
				array(
					'permisoid'      => 6,
					'nombre'         => 'destroy',
					'nombrefriendly' => 'Borrar'
				),
				array(
					'permisoid'      => 7,
					'nombre'         => 'show',
					'nombrefriendly' => 'Mostrar datos'
				),
				array(
					'permisoid'      => 11,
					'nombre'         => 'generar',
					'nombrefriendly' => 'Generar'
				),
				array(
					'permisoid'      => 12,
					'nombre'         => 'anular',
					'nombrefriendly' => 'Anular'
				),
				array(
	        'permisoid'      => 16,
	        'nombre'         => 'procesaranulacion',
	        'nombrefriendly' => 'Procesar anulación'
				),
				array(
	        'permisoid'      => 17,
	        'nombre'         => 'saldo',
	        'nombrefriendly' => 'Saldos'
				),
				array(
	        'permisoid'      => 18,
	        'nombre'         => 'archivos',
	        'nombrefriendly' => 'Archivos'
				),
				array(
	        'permisoid'      => 19,
	        'nombre'         => 'buscar',
	        'nombrefriendly' => 'Buscar'
				),
			));

			DB::table('authpermisos')->update(array('created_at'=>date_create(), 'updated_at'=>date_create()));
		  DB::statement('SET FOREIGN_KEY_CHECKS=1');
		}
	}