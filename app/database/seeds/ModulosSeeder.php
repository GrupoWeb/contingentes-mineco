<?php
class ModulosSeeder extends Seeder {
	public function run(){
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('authmodulos')->truncate();

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 1,
			'nombre'         => 'index',
			'nombrefriendly' => 'Inicio',
			'descripcion' => ''
		));
	
		DB::table('authmodulos')->insert(array(
			'moduloid'       => 2,
			'nombre'         => 'usuarios',
			'nombrefriendly' => 'Usuarios DACE',
			'descripcion' => ''
		));
	
		DB::table('authmodulos')->insert(array(
			'moduloid'       => 3,
			'nombre'         => 'roles',
			'nombrefriendly' => 'Roles',
			'descripcion' => ''
		));
	
		DB::table('authmodulos')->insert(array(
			'moduloid'       => 4,
			'nombre'         => 'contingentes',
			'nombrefriendly' => 'Contingentes',
			'descripcion' => ''
		));
	
		DB::table('authmodulos')->insert(array(
			'moduloid'       => 5,
			'nombre'         => 'requerimientos',
			'nombrefriendly' => 'Requerimientos',
			'descripcion' => ''
		));
	
		DB::table('authmodulos')->insert(array(
			'moduloid'       => 6,
			'nombre'         => 'tratados',
			'nombrefriendly' => 'Tratados',
			'descripcion' => ''
		));
	
		DB::table('authmodulos')->insert(array(
			'moduloid'       => 7,
			'nombre'         => 'periodos',
			'nombrefriendly' => 'Periodos',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 8,
			'nombre'         => 'productos',
			'nombrefriendly' => 'Productos',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 9,
			'nombre'         => 'solicitudespendientes.asignacion',
			'nombrefriendly' => 'Solicitudes pendientes asignación',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 10,
			'nombre'         => 'solicitudespendientes.inscripcion',
			'nombrefriendly' => 'Solicitudes pendientes inscripción',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 11,
			'nombre'         => 'certificados',
			'nombrefriendly' => 'Certificados',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 12,
			'nombre'         => 'solicitud.emision',
			'nombrefriendly' => 'Solicitud de emisión',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 13,
			'nombre'         => 'contingente.requerimientos',
			'nombrefriendly' => 'Contingentes - Requerimientos',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 14,
			'nombre'         => 'solicitud.asignacion',
			'nombrefriendly' => 'Solicitud de asignación',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 15,
			'nombre'         => 'solicitudespendientes.emision',
			'nombrefriendly' => 'Solicitudes pendientes emisión',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 16,
			'nombre'         => 'partidasarancelarias',
			'nombrefriendly' => 'Partidas arancelarias',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 17,
			'nombre'         => 'periodosasignaciones',
			'nombrefriendly' => 'Periodo asignaciones',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 18,
			'nombre'         => 'cuentacorriente',
			'nombrefriendly' => 'Cuenta corriente - Contingentes',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 19,
			'nombre'         => 'historicosolicitudes.inscripcion',
			'nombrefriendly' => 'Histórico de Inscripciones',
			'descripcion' => ''
		));			
        
    DB::table('authmodulos')->insert(array(
			'moduloid'       => 20,
			'nombre'         => 'empresas',
			'nombrefriendly' => 'Reporte de empresas inscritas',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 21,
			'nombre'         => 'paises',
			'nombrefriendly' => 'Países',
			'descripcion' => ''
		));
          
		DB::table('authmodulos')->insert(array(
			'moduloid'       => 22,
			'nombre'         => 'solicitud.inscripcion',
			'nombrefriendly' => 'Solicitud de inscripción',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 23,
			'nombre'         => 'usuarioswebservice',
			'nombrefriendly' => 'Usuarios webservice',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 24,
			'nombre'         => 'historicosolicitudes.asignacion',
			'nombrefriendly' => 'Histórico de asignación',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 25,
			'nombre'         => 'historicosolicitudes.emision',
			'nombrefriendly' => 'Histórico de emisión',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 26,
			'nombre'         => 'tratado.graficas',
			'nombrefriendly' => 'Gráficas tratados',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 27,
			'nombre'         => 'unidadesmedida',
			'nombrefriendly' => 'Unidades de medida',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 28,
			'nombre'         => 'usuarioempresas',
			'nombrefriendly' => 'Usuarios empresas',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 29,
			'nombre'         => 'cuentacorrienteempresas',
			'nombrefriendly' => 'Cuenta corriente - Empresas',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 30,
			'nombre'         => 'periodospenalizaciones',
			'nombrefriendly' => 'Periodo penalizaciones',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 31,
			'nombre'         => 'usuariosextra',
			'nombrefriendly' => 'Usuarios extra',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 32,
			'nombre'         => 'utilizacion',
			'nombrefriendly' => 'Utilización de contingentes',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 33,
			'nombre'         => 'consolidadoutilizacion',
			'nombrefriendly' => 'Consolidado de utilización de contingentes',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 34,
			'nombre'         => 'utilizacionporempresa',
			'nombrefriendly' => 'Utilización de contingentes por empresa',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 35,
			'nombre'         => 'utilizacionporempresagrafica',
			'nombrefriendly' => 'Gráfica utilización de contingentes por empresa',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 36,
			'nombre'         => 'solicitud.actualizacion',
			'nombrefriendly' => 'Solicitud actualizacion',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 37,
			'nombre'         => 'solicitudespendientes.actualizacion',
			'nombrefriendly' => 'Solicitudes pendientes actualizacion',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 38,
			'nombre'         => 'periodoconstancias',
			'nombrefriendly' => 'Periodo constancias',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 39,
			'nombre'         => 'historicosolicitudes.actualizacion',
			'nombrefriendly' => 'Histórico de Actualizaciones',
			'descripcion' => ''
		));

		DB::table('authmodulos')->insert(array(
			'moduloid'       => 41,
			'nombre'         => 'certificadosempresas',
			'nombrefriendly' => 'Reporte - Certificados de empresas',
			'descripcion'    => ''
		));

		DB::table('authmodulos')->update(array('created_at'=>date_create(), 'updated_at'=>date_create()));
	  DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}