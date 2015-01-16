<?php
	class ModuloPermisosSeeder extends Seeder {
		public function run(){
			DB::statement('SET FOREIGN_KEY_CHECKS=0');
			DB::table('authmodulopermisos')->truncate();

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 1,
				'moduloid'        => 1,
				'permisoid' 			=> 1,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 2,
				'moduloid'        => 2,
				'permisoid' 			=> 1,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 3,
				'moduloid'        => 2,
				'permisoid' 			=> 2,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 4,
				'moduloid'        => 2,
				'permisoid' 			=> 3,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 5,
				'moduloid'        => 2,
				'permisoid' 			=> 4,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 6,
				'moduloid'        => 2,
				'permisoid' 			=> 5,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 7,
				'moduloid'        => 2,
				'permisoid' 			=> 6,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 8,
				'moduloid'        => 2,
				'permisoid' 			=> 7,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 9,
				'moduloid'        => 3,
				'permisoid' 			=> 1,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 10,
				'moduloid'        => 3,
				'permisoid' 			=> 2,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 11,
				'moduloid'        => 3,
				'permisoid' 			=> 3,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 12,
				'moduloid'        => 3,
				'permisoid' 			=> 4,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 13,
				'moduloid'        => 3,
				'permisoid' 			=> 5,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 14,
				'moduloid'        => 3,
				'permisoid' 			=> 6,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 15,
				'moduloid'        => 3,
				'permisoid' 			=> 7,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 16,
				'moduloid'        => 4,
				'permisoid' 			=> 5,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 17,
				'moduloid'        => 4,
				'permisoid' 			=> 6,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 18,
				'moduloid'        => 4,
				'permisoid' 			=> 2,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 19,
				'moduloid'        => 4,
				'permisoid' 			=> 4,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 20,
				'moduloid'        => 4,
				'permisoid' 			=> 3,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 21,
				'moduloid'        => 4,
				'permisoid' 			=> 7,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 22,
				'moduloid'        => 4,
				'permisoid' 			=> 1,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 23,
				'moduloid'        => 5,
				'permisoid' 			=> 5,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 24,
				'moduloid'        => 5,
				'permisoid' 			=> 6,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 25,
				'moduloid'        => 5,
				'permisoid' 			=> 2,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 26,
				'moduloid'        => 5,
				'permisoid' 			=> 4,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 27,
				'moduloid'        => 5,
				'permisoid' 			=> 3,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 28,
				'moduloid'        => 5,
				'permisoid' 			=> 7,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 29,
				'moduloid'        => 5,
				'permisoid' 			=> 1,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 30,
				'moduloid'        => 6,
				'permisoid' 			=> 5,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 31,
				'moduloid'        => 6,
				'permisoid' 			=> 6,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 32,
				'moduloid'        => 6,
				'permisoid' 			=> 2,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 33,
				'moduloid'        => 6,
				'permisoid' 			=> 4,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 34,
				'moduloid'        => 6,
				'permisoid' 			=> 3,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 35,
				'moduloid'        => 6,
				'permisoid' 			=> 7,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 36,
				'moduloid'        => 6,
				'permisoid' 			=> 1,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 37,
				'moduloid'        => 7,
				'permisoid' 			=> 5,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 38,
				'moduloid'        => 7,
				'permisoid' 			=> 6,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 39,
				'moduloid'        => 7,
				'permisoid' 			=> 2,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 40,
				'moduloid'        => 7,
				'permisoid' 			=> 4,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 41,
				'moduloid'        => 7,
				'permisoid' 			=> 3,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 42,
				'moduloid'        => 7,
				'permisoid' 			=> 7,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 43,
				'moduloid'        => 7,
				'permisoid' 			=> 1,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 44,
				'moduloid'        => 8,
				'permisoid' 			=> 5,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 45,
				'moduloid'        => 8,
				'permisoid' 			=> 6,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 46,
				'moduloid'        => 8,
				'permisoid' 			=> 2,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 47,
				'moduloid'        => 8,
				'permisoid' 			=> 4,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 48,
				'moduloid'        => 8,
				'permisoid' 			=> 3,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 49,
				'moduloid'        => 8,
				'permisoid' 			=> 7,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 50,
				'moduloid'        => 8,
				'permisoid' 			=> 1,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 51,
				'moduloid'        => 9,
				'permisoid' 			=> 1,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 53,
				'moduloid'        => 9,
				'permisoid' 			=> 3,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 54,
				'moduloid'        => 9,
				'permisoid' 			=> 4,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 57,
				'moduloid'        => 9,
				'permisoid' 			=> 7,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 61,
				'moduloid'        => 11,
				'permisoid' 			=> 11,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 62,
				'moduloid'        => 12,
				'permisoid' 			=> 1,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 63,
				'moduloid'        => 13,
				'permisoid' 			=> 1,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 64,
				'moduloid'        => 13,
				'permisoid' 			=> 3,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 65,
				'moduloid'        => 10,
				'permisoid' 			=> 1,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 66,
				'moduloid'        => 10,
				'permisoid' 			=> 3,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 67,
				'moduloid'        => 10,
				'permisoid' 			=> 4,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 68,
				'moduloid'        => 10,
				'permisoid' 			=> 7,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 69,
				'moduloid'        => 12,
				'permisoid' 			=> 3,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 70,
				'moduloid'        => 14,
				'permisoid' 			=> 1,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 71,
				'moduloid'        => 14,
				'permisoid' 			=> 3,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 72,
				'moduloid'        => 15,
				'permisoid' 			=> 1,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 74,
				'moduloid'        => 15,
				'permisoid' 			=> 3,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 75,
				'moduloid'        => 15,
				'permisoid' 			=> 4,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 78,
				'moduloid'        => 15,
				'permisoid' 			=> 7,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));
		  
		  DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 79,
				'moduloid'        => 11,
				'permisoid' 			=> 1,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 80,
				'moduloid'        => 11,
				'permisoid' 			=> 7,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 81,
				'moduloid'        => 16,
				'permisoid' 			=> 1,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 82,
				'moduloid'        => 16,
				'permisoid' 			=> 2,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 83,
				'moduloid'        => 16,
				'permisoid' 			=> 3,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 84,
				'moduloid'        => 16,
				'permisoid' 			=> 4,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 85,
				'moduloid'        => 16,
				'permisoid' 			=> 5,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 86,
				'moduloid'        => 16,
				'permisoid' 			=> 6,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 87,
				'moduloid'        => 16,
				'permisoid' 			=> 7,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 88,
				'moduloid'        => 17,
				'permisoid' 			=> 1,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 89,
				'moduloid'        => 17,
				'permisoid' 			=> 3,
				'created_at'     	=> date_create(), 'updated_at' => date_create()
			));

		  DB::statement('SET FOREIGN_KEY_CHECKS=1');
		}
	}
//Termina ModuloPermisosSeeder.php