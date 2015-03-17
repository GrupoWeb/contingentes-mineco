<?php

class DatabaseSeeder extends Seeder {
	public function run()	{
		Eloquent::unguard();
		$this->call('ModulosSeeder');
		$this->call('PermisosSeeder');
		$this->call('ModulopermisosSeeder');
		$this->call('MenuSeeder');
		$this->call('TipotratadosSeeder');
		$this->call('PlantillaCertificadosSeeder');
	}
}