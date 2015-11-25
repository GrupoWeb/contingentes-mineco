<?php
	class ModuloPermisosSeeder extends Seeder {
		public function run(){
			DB::statement('SET FOREIGN_KEY_CHECKS=0');
			DB::table('authmodulopermisos')->truncate();

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 1,
				'moduloid'        => 1,
				'permisoid' 			=> 1
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 2,
				'moduloid'        => 2,
				'permisoid' 			=> 1
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 3,
				'moduloid'        => 2,
				'permisoid' 			=> 2
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 4,
				'moduloid'        => 2,
				'permisoid' 			=> 3
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 5,
				'moduloid'        => 2,
				'permisoid' 			=> 4
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 6,
				'moduloid'        => 2,
				'permisoid' 			=> 5
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 7,
				'moduloid'        => 2,
				'permisoid' 			=> 6
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 8,
				'moduloid'        => 2,
				'permisoid' 			=> 7
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 9,
				'moduloid'        => 3,
				'permisoid' 			=> 1
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 10,
				'moduloid'        => 3,
				'permisoid' 			=> 2
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 11,
				'moduloid'        => 3,
				'permisoid' 			=> 3
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 12,
				'moduloid'        => 3,
				'permisoid' 			=> 4
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 13,
				'moduloid'        => 3,
				'permisoid' 			=> 5
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 14,
				'moduloid'        => 3,
				'permisoid' 			=> 6
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 15,
				'moduloid'        => 3,
				'permisoid' 			=> 7
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 16,
				'moduloid'        => 4,
				'permisoid' 			=> 5
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 17,
				'moduloid'        => 4,
				'permisoid' 			=> 6
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 18,
				'moduloid'        => 4,
				'permisoid' 			=> 2
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 19,
				'moduloid'        => 4,
				'permisoid' 			=> 4
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 20,
				'moduloid'        => 4,
				'permisoid' 			=> 3
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 21,
				'moduloid'        => 4,
				'permisoid' 			=> 7
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 22,
				'moduloid'        => 4,
				'permisoid' 			=> 1
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 23,
				'moduloid'        => 5,
				'permisoid' 			=> 5
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 24,
				'moduloid'        => 5,
				'permisoid' 			=> 6
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 25,
				'moduloid'        => 5,
				'permisoid' 			=> 2
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 26,
				'moduloid'        => 5,
				'permisoid' 			=> 4
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 27,
				'moduloid'        => 5,
				'permisoid' 			=> 3
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 28,
				'moduloid'        => 5,
				'permisoid' 			=> 7
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 29,
				'moduloid'        => 5,
				'permisoid' 			=> 1
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 30,
				'moduloid'        => 6,
				'permisoid' 			=> 5
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 31,
				'moduloid'        => 6,
				'permisoid' 			=> 6
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 32,
				'moduloid'        => 6,
				'permisoid' 			=> 2
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 33,
				'moduloid'        => 6,
				'permisoid' 			=> 4
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 34,
				'moduloid'        => 6,
				'permisoid' 			=> 3
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 35,
				'moduloid'        => 6,
				'permisoid' 			=> 7
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 36,
				'moduloid'        => 6,
				'permisoid' 			=> 1
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 37,
				'moduloid'        => 7,
				'permisoid' 			=> 5
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 38,
				'moduloid'        => 7,
				'permisoid' 			=> 6
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 39,
				'moduloid'        => 7,
				'permisoid' 			=> 2
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 40,
				'moduloid'        => 7,
				'permisoid' 			=> 4
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 41,
				'moduloid'        => 7,
				'permisoid' 			=> 3
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 42,
				'moduloid'        => 7,
				'permisoid' 			=> 7
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 43,
				'moduloid'        => 7,
				'permisoid' 			=> 1
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 44,
				'moduloid'        => 8,
				'permisoid' 			=> 5
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 45,
				'moduloid'        => 8,
				'permisoid' 			=> 6
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 46,
				'moduloid'        => 8,
				'permisoid' 			=> 2
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 47,
				'moduloid'        => 8,
				'permisoid' 			=> 4
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 48,
				'moduloid'        => 8,
				'permisoid' 			=> 3
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 49,
				'moduloid'        => 8,
				'permisoid' 			=> 7
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 50,
				'moduloid'        => 8,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 51,
				'moduloid'        => 9,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 53,
				'moduloid'        => 9,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 54,
				'moduloid'        => 9,
				'permisoid' 			=> 4
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 57,
				'moduloid'        => 9,
				'permisoid' 			=> 7
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 61,
				'moduloid'        => 11,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 62,
				'moduloid'        => 12,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 63,
				'moduloid'        => 13,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 64,
				'moduloid'        => 13,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 65,
				'moduloid'        => 10,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 66,
				'moduloid'        => 10,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 67,
				'moduloid'        => 10,
				'permisoid' 			=> 4
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 68,
				'moduloid'        => 10,
				'permisoid' 			=> 7
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 69,
				'moduloid'        => 12,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 70,
				'moduloid'        => 14,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 71,
				'moduloid'        => 14,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 72,
				'moduloid'        => 15,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 74,
				'moduloid'        => 15,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 75,
				'moduloid'        => 15,
				'permisoid' 			=> 4
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 78,
				'moduloid'        => 15,
				'permisoid' 			=> 7
			));
		  
		  /*DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 79,
				'moduloid'        => 11,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 80,
				'moduloid'        => 11,
				'permisoid' 			=> 7
			));*/

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 81,
				'moduloid'        => 16,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 82,
				'moduloid'        => 16,
				'permisoid' 			=> 2
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 83,
				'moduloid'        => 16,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 84,
				'moduloid'        => 16,
				'permisoid' 			=> 4
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 85,
				'moduloid'        => 16,
				'permisoid' 			=> 5
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 86,
				'moduloid'        => 16,
				'permisoid' 			=> 6
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 87,
				'moduloid'        => 16,
				'permisoid' 			=> 7
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 88,
				'moduloid'        => 17,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 89,
				'moduloid'        => 17,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 90,
				'moduloid'        => 18,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 91,
				'moduloid'        => 18,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 92,
				'moduloid'        => 19,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 93,
				'moduloid'        => 19,
				'permisoid' 			=> 7
			)); 
          
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 94,
				'moduloid'        => 20,
				'permisoid' 			=> 1
			));
          
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 95,
				'moduloid'        => 20,
				'permisoid' 			=> 3
			));

      /*DB::table('authmodulopermisos')->insert(array(
          'modulopermisoid'	=> 96,
          'moduloid'        => 2,
          'permisoid' 			=> 12
      ));*/

      DB::table('authmodulopermisos')->insert(array(
          'modulopermisoid'	=> 97,
          'moduloid'        => 11,
          'permisoid' 			=> 12
      ));

      DB::table('authmodulopermisos')->insert(array(
          'modulopermisoid'	=> 98,
          'moduloid'        => 21,
          'permisoid' 			=> 1
      ));

      DB::table('authmodulopermisos')->insert(array(
          'modulopermisoid'	=> 99,
          'moduloid'        => 21,
          'permisoid' 			=> 2
      ));

      DB::table('authmodulopermisos')->insert(array(
          'modulopermisoid'	=> 100,
          'moduloid'        => 21,
          'permisoid' 			=> 3
      ));

      DB::table('authmodulopermisos')->insert(array(
          'modulopermisoid'	=> 101,
          'moduloid'        => 21,
          'permisoid' 			=> 4
      ));

      DB::table('authmodulopermisos')->insert(array(
          'modulopermisoid'	=> 102,
          'moduloid'        => 21,
          'permisoid' 			=> 5
      ));

      DB::table('authmodulopermisos')->insert(array(
          'modulopermisoid'	=> 103,
          'moduloid'        => 21,
          'permisoid' 			=> 6
      ));

      DB::table('authmodulopermisos')->insert(array(
          'modulopermisoid'	=> 104,
          'moduloid'        => 21,
          'permisoid' 			=> 7
      ));
            
      DB::table('authmodulopermisos')->insert(array(
          'modulopermisoid'	=> 108,
          'moduloid'        => 22,
          'permisoid' 			=> 3
      ));
            
      DB::table('authmodulopermisos')->insert(array(
          'modulopermisoid'	=> 109,
          'moduloid'        => 22,
          'permisoid' 			=> 1
      ));

      DB::table('authmodulopermisos')->insert(array(
          'modulopermisoid'	=> 110,
          'moduloid'        => 11,
          'permisoid' 			=> 16
      ));

      DB::table('authmodulopermisos')->insert(array(
          'modulopermisoid'	=> 111,
          'moduloid'        => 23,
          'permisoid' 			=> 1
      ));

      DB::table('authmodulopermisos')->insert(array(
          'modulopermisoid'	=> 112,
          'moduloid'        => 23,
          'permisoid' 			=> 2
      ));

      DB::table('authmodulopermisos')->insert(array(
          'modulopermisoid'	=> 113,
          'moduloid'        => 23,
          'permisoid' 			=> 3
      ));

      DB::table('authmodulopermisos')->insert(array(
          'modulopermisoid'	=> 114,
          'moduloid'        => 23,
          'permisoid' 			=> 4
      ));

      DB::table('authmodulopermisos')->insert(array(
          'modulopermisoid'	=> 115,
          'moduloid'        => 23,
          'permisoid' 			=> 5
      ));

      DB::table('authmodulopermisos')->insert(array(
          'modulopermisoid'	=> 116,
          'moduloid'        => 23,
          'permisoid' 			=> 6
      ));

      DB::table('authmodulopermisos')->insert(array(
          'modulopermisoid'	=> 117,
          'moduloid'        => 23,
          'permisoid' 			=> 7
      ));

      DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 118,
				'moduloid'        => 24,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 119,
				'moduloid'        => 24,
				'permisoid' 			=> 7
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 120,
				'moduloid'        => 25,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 121,
				'moduloid'        => 25,
				'permisoid' 			=> 7
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 122,
				'moduloid'        => 26,
				'permisoid' 			=> 17
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 123,
				'moduloid'        => 27,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 124,
				'moduloid'        => 27,
				'permisoid' 			=> 2
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 125,
				'moduloid'        => 27,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 126,
				'moduloid'        => 27,
				'permisoid' 			=> 4
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 128,
				'moduloid'        => 27,
				'permisoid' 			=> 5
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 129,
				'moduloid'        => 27,
				'permisoid' 			=> 6
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 130,
				'moduloid'        => 27,
				'permisoid' 			=> 7
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 131,
				'moduloid'        => 28,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 133,
				'moduloid'        => 28,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 134,
				'moduloid'        => 28,
				'permisoid' 			=> 4
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 135,
				'moduloid'        => 28,
				'permisoid' 			=> 5
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 137,
				'moduloid'        => 28,
				'permisoid' 			=> 7
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 138,
				'moduloid'        => 29,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 139,
				'moduloid'        => 29,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 140,
				'moduloid'        => 30,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 141,
				'moduloid'        => 30,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 142,
				'moduloid'        => 31,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 143,
				'moduloid'        => 31,
				'permisoid' 			=> 2
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 144,
				'moduloid'        => 31,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 145,
				'moduloid'        => 31,
				'permisoid' 			=> 4
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 146,
				'moduloid'        => 31,
				'permisoid' 			=> 5
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 147,
				'moduloid'        => 31,
				'permisoid' 			=> 6
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 148,
				'moduloid'        => 31,
				'permisoid' 			=> 7
			));


			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 149,
				'moduloid'        => 19,
				'permisoid' 			=> 18
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 150,
				'moduloid'        => 24,
				'permisoid' 			=> 18
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 151,
				'moduloid'        => 25,
				'permisoid' 			=> 18
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 152,
				'moduloid'        => 32,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 153,
				'moduloid'        => 32,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 154,
				'moduloid'        => 33,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 155,
				'moduloid'        => 33,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 156,
				'moduloid'        => 34,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 157,
				'moduloid'        => 34,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 158,
				'moduloid'        => 35,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 159,
				'moduloid'        => 35,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 160,
				'moduloid'        => 11,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 161,
				'moduloid'        => 36,
				'permisoid' 			=> 1
			));
		
			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 163,
				'moduloid'        => 36,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 164,
				'moduloid'        => 37,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 166,
				'moduloid'        => 37,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 167,
				'moduloid'        => 37,
				'permisoid' 			=> 4
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 170,
				'moduloid'        => 37,
				'permisoid' 			=> 7
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 171,
				'moduloid'        => 38,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 172,
				'moduloid'        => 38,
				'permisoid' 			=> 7
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 173,
				'moduloid'        => 39,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 174,
				'moduloid'        => 39,
				'permisoid' 			=> 2
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 175,
				'moduloid'        => 39,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 176,
				'moduloid'        => 39,
				'permisoid' 			=> 4
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 177,
				'moduloid'        => 39,
				'permisoid' 			=> 5
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 178,
				'moduloid'        => 39,
				'permisoid' 			=> 6
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 179,
				'moduloid'        => 39,
				'permisoid' 			=> 7
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 180,
				'moduloid'        => 39,
				'permisoid' 			=> 18
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 183,
				'moduloid'        => 41,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 184,
				'moduloid'        => 41,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 185,
				'moduloid'        => 42,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 186,
				'moduloid'        => 42,
				'permisoid' 			=> 2
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 187,
				'moduloid'        => 42,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 188,
				'moduloid'        => 42,
				'permisoid' 			=> 4
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 189,
				'moduloid'        => 42,
				'permisoid' 			=> 5
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 190,
				'moduloid'        => 42,
				'permisoid' 			=> 6
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 191,
				'moduloid'        => 42,
				'permisoid' 			=> 7
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 192,
				'moduloid'        => 43,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 193,
				'moduloid'        => 44,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 194,
				'moduloid'        => 44,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 195,
				'moduloid'        => 44,
				'permisoid' 			=> 7
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 196,
				'moduloid'        => 45,
				'permisoid' 			=> 1
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 197,
				'moduloid'        => 45,
				'permisoid' 			=> 3
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 198,
				'moduloid'        => 45,
				'permisoid' 			=> 4
			));

			DB::table('authmodulopermisos')->insert(array(
				'modulopermisoid'	=> 199,
				'moduloid'        => 45,
				'permisoid' 			=> 7
			));
		
		  DB::table('authmodulopermisos')->update(array('created_at'=>date_create(), 'updated_at'=>date_create()));
		  DB::statement('SET FOREIGN_KEY_CHECKS=1');
		}
	}