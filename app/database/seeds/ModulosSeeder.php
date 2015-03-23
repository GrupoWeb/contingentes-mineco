<?php
class ModulosSeeder extends Seeder {
	public function run(){
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('authmodulos')->truncate();

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 1,
			'nombre'         => 'index',
			'nombrefriendly' => 'Inicio'
		));
	
		DB::table('authmodulos')->insert(array(
			'moduloid'       => 2,
			'nombre'         => 'usuarios',
			'nombrefriendly' => 'Usuarios DACE'
		));
	
		DB::table('authmodulos')->insert(array(
			'moduloid'       => 3,
			'nombre'         => 'roles',
			'nombrefriendly' => 'Roles'
		));
	
		DB::table('authmodulos')->insert(array(
			'moduloid'       => 4,
			'nombre'         => 'contingentes',
			'nombrefriendly' => 'Contingentes'
		));
	
		DB::table('authmodulos')->insert(array(
			'moduloid'       => 5,
			'nombre'         => 'requerimientos',
			'nombrefriendly' => 'Requerimientos'
		));
	
		DB::table('authmodulos')->insert(array(
			'moduloid'       => 6,
			'nombre'         => 'tratados',
			'nombrefriendly' => 'Tratados'
		));
	
		DB::table('authmodulos')->insert(array(
			'moduloid'       => 7,
			'nombre'         => 'periodos',
			'nombrefriendly' => 'Periodos'
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 8,
			'nombre'         => 'productos',
			'nombrefriendly' => 'Productos'
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 9,
			'nombre'         => 'solicitudespendientes.asignacion',
			'nombrefriendly' => 'Solicitudes pendientes asignación'
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 10,
			'nombre'         => 'solicitudespendientes.inscripcion',
			'nombrefriendly' => 'Solicitudes pendientes inscripción'
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 11,
			'nombre'         => 'certificados',
			'nombrefriendly' => 'Certificados'
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 12,
			'nombre'         => 'solicitud.emision',
			'nombrefriendly' => 'Solicitud de emisión'
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 13,
			'nombre'         => 'contingente.requerimientos',
			'nombrefriendly' => 'Contingentes - Requerimientos'
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 14,
			'nombre'         => 'solicitud.asignacion',
			'nombrefriendly' => 'Solicitud de asignación'
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 15,
			'nombre'         => 'solicitudespendientes.emision',
			'nombrefriendly' => 'Solicitudes pendientes emisión'
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 16,
			'nombre'         => 'partidasarancelarias',
			'nombrefriendly' => 'Partidas arancelarias'
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 17,
			'nombre'         => 'periodosasignaciones',
			'nombrefriendly' => 'Periodo asignaciones'
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 18,
			'nombre'         => 'cuentacorriente',
			'nombrefriendly' => 'Cuenta corriente - Contingentes'
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 19,
			'nombre'         => 'historicosolicitudes.inscripcion',
			'nombrefriendly' => 'Histórico de Inscripciones'
		));			
        
    DB::table('authmodulos')->insert(array(
			'moduloid'       => 20,
			'nombre'         => 'empresas',
			'nombrefriendly' => 'Reporte de empresas inscritas'
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 21,
			'nombre'         => 'paises',
			'nombrefriendly' => 'Países'
		));
          
		DB::table('authmodulos')->insert(array(
			'moduloid'       => 22,
			'nombre'         => 'solicitud.inscripcion',
			'nombrefriendly' => 'Solicitud de inscripción'
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 23,
			'nombre'         => 'usuarioswebservice',
			'nombrefriendly' => 'Usuarios webservice'
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 24,
			'nombre'         => 'historicosolicitudes.asignacion',
			'nombrefriendly' => 'Histórico de asignación'
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 25,
			'nombre'         => 'historicosolicitudes.emision',
			'nombrefriendly' => 'Histórico de emisión'
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 26,
			'nombre'         => 'tratado.graficas',
			'nombrefriendly' => 'Gráficas tratados'
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 27,
			'nombre'         => 'unidadesmedida',
			'nombrefriendly' => 'Unidades de medida'
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 28,
			'nombre'         => 'usuarioempresas',
			'nombrefriendly' => 'Usuarios empresas'
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 29,
			'nombre'         => 'cuentacorrienteempresas',
			'nombrefriendly' => 'Cuenta corriente - Empresas'
		));

		DB::table('authmodulos')->update(array('created_at'=>date_create(), 'updated_at'=>date_create()));
	  DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}