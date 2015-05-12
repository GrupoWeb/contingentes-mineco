<?php
	class PlantillaCertificadosSeeder extends Seeder {

		public function run(){
			DB::statement('SET FOREIGN_KEY_CHECKS=0');
			DB::table('plantillascertificados')->truncate();

			DB::table('plantillascertificados')->insert(array(
				'plantillaid' => 1,
				'nombre'      => 'Certificado genérico',
				'vista'       => 'certificados.adjudicacion'
			));
		
			DB::table('plantillascertificados')->insert(array(
				'plantillaid' => 2,
				'nombre'      => 'Certificado banano',
				'vista'       => 'certificados.banano'
			));

			DB::table('plantillascertificados')->insert(array(
				'plantillaid' => 3,
				'nombre'      => 'Certificado VUPE',
				'vista'       => 'certificados.vupe'
			));

			DB::table('plantillascertificados')->update(array('created_at'=>date_create(), 'updated_at'=>date_create()));
		  DB::statement('SET FOREIGN_KEY_CHECKS=1');
		}
	}