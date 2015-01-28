<?php
	class ModulosSeeder extends Seeder {
		public function run(){
			DB::statement('SET FOREIGN_KEY_CHECKS=0');
			DB::table('authmodulos')->truncate();

			DB::table('authmodulos')->insert(array(
				'moduloid'       => 1,
				'nombre'         => 'index',
				'nombrefriendly' => 'Inicio',
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
				'nombrefriendly' => 'Contingentes',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulos')->insert(array(
				'moduloid'       => 5,
				'nombre'         => 'requerimientos',
				'nombrefriendly' => 'Requerimientos',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulos')->insert(array(
				'moduloid'       => 6,
				'nombre'         => 'tratados',
				'nombrefriendly' => 'Tratados',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulos')->insert(array(
				'moduloid'       => 7,
				'nombre'         => 'periodos',
				'nombrefriendly' => 'Periodos',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulos')->insert(array(
				'moduloid'       => 8,
				'nombre'         => 'productos',
				'nombrefriendly' => 'Productos',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulos')->insert(array(
				'moduloid'       => 9,
				'nombre'         => 'solicitudespendientes.asignacion',
				'nombrefriendly' => 'Solicitudes pendientes asignación',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulos')->insert(array(
				'moduloid'       => 10,
				'nombre'         => 'solicitudespendientes.inscripcion',
				'nombrefriendly' => 'Solicitudes pendientes inscripción',
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
				'nombrefriendly' => 'Contingentes - Requerimientos',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulos')->insert(array(
				'moduloid'       => 14,
				'nombre'         => 'solicitud.asignacion',
				'nombrefriendly' => 'Solicitud de asignación',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulos')->insert(array(
				'moduloid'       => 15,
				'nombre'         => 'solicitudespendientes.emision',
				'nombrefriendly' => 'Solicitudes pendientes emisión',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulos')->insert(array(
				'moduloid'       => 16,
				'nombre'         => 'partidasarancelarias',
				'nombrefriendly' => 'Partidas arancelarias',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulos')->insert(array(
				'moduloid'       => 17,
				'nombre'         => 'periodosasignaciones',
				'nombrefriendly' => 'Periodo asignaciones',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulos')->insert(array(
				'moduloid'       => 18,
				'nombre'         => 'cuentacorriente',
				'nombrefriendly' => 'Cuenta corriente',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulos')->insert(array(
				'moduloid'       => 19,
				'nombre'         => 'historicosolicitudes',
				'nombrefriendly' => 'Histórico de solicitudes',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));			
          
      DB::table('authmodulos')->insert(array(
				'moduloid'       => 20,
				'nombre'         => 'empresas',
				'nombrefriendly' => 'Reporte de empresas inscritas',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulos')->insert(array(
				'moduloid'       => 21,
				'nombre'         => 'paises',
				'nombrefriendly' => 'Países',
				'created_at'     => date_create(), 'updated_at' => date_create()
			));

		  DB::statement('SET FOREIGN_KEY_CHECKS=1');
		}
	}
//Termina ModulosSeeder.php