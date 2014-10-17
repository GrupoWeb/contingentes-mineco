<?php

class UsuarioSeeder extends Seeder {
	public function run() {

		DB::table('authroles')->insert(array(
			'rolid'				=> 1,
			'nombre'      => 'CS Admin',
			'descripcion' => 'Rol backdoor que permite realizar todas las acciones del sistema',
			'created_at'  => date_create(), 'updated_at' => date_create()
		));

		DB::table('authroles')->insert(array(
			'rolid'				=> 2,
			'nombre'      => 'DACE',
			'descripcion' => 'Rol de la DACE',
			'created_at'  => date_create(), 'updated_at' => date_create()
		));

		DB::table('authroles')->insert(array(
			'rolid'				=> 3,
			'nombre'      => 'Empresa',
			'descripcion' => 'Rol de empresa',
			'created_at'  => date_create(), 'updated_at' => date_create()
		));

		DB::table('authusuarios')->insert(array(
			'usuarioid'      => 1,
			'email'          => 'cs@cs.com.gt',
			'password'       => '$2y$10$zOrPimtXtgVXl/nphcryoeo/mxS0oB6uBQZpmZFIB8M8ad1wc9vMi',
			'rolid'          => 1,
			'nombre'         => 'Compuservice',
			'activo'         => 1,
			'cambiopassword' => 0,
			'notificar'      => 1,
			'created_at'  => date_create(), 'updated_at' => date_create()
		));
	}
}