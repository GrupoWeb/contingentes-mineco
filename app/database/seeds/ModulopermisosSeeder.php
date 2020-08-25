<?php
class ModuloPermisosSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('authmodulopermisos')->truncate();

        DB::table('authmodulopermisos')->insert([
            [
                'modulopermisoid' => 1,
                'moduloid'        => 1,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 2,
                'moduloid'        => 2,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 3,
                'moduloid'        => 2,
                'permisoid'       => 2,
            ],
            [
                'modulopermisoid' => 4,
                'moduloid'        => 2,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 5,
                'moduloid'        => 2,
                'permisoid'       => 4,
            ],
            [
                'modulopermisoid' => 6,
                'moduloid'        => 2,
                'permisoid'       => 5,
            ],
            [
                'modulopermisoid' => 7,
                'moduloid'        => 2,
                'permisoid'       => 6,
            ],
            [
                'modulopermisoid' => 8,
                'moduloid'        => 2,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 9,
                'moduloid'        => 3,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 10,
                'moduloid'        => 3,
                'permisoid'       => 2,
            ],
            [
                'modulopermisoid' => 11,
                'moduloid'        => 3,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 12,
                'moduloid'        => 3,
                'permisoid'       => 4,
            ],
            [
                'modulopermisoid' => 13,
                'moduloid'        => 3,
                'permisoid'       => 5,
            ],
            [
                'modulopermisoid' => 14,
                'moduloid'        => 3,
                'permisoid'       => 6,
            ],
            [
                'modulopermisoid' => 15,
                'moduloid'        => 3,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 16,
                'moduloid'        => 4,
                'permisoid'       => 5,
            ],
            [
                'modulopermisoid' => 17,
                'moduloid'        => 4,
                'permisoid'       => 6,
            ],
            [
                'modulopermisoid' => 18,
                'moduloid'        => 4,
                'permisoid'       => 2,
            ],
            [
                'modulopermisoid' => 19,
                'moduloid'        => 4,
                'permisoid'       => 4,
            ],
            [
                'modulopermisoid' => 20,
                'moduloid'        => 4,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 21,
                'moduloid'        => 4,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 22,
                'moduloid'        => 4,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 23,
                'moduloid'        => 5,
                'permisoid'       => 5,
            ],
            [
                'modulopermisoid' => 24,
                'moduloid'        => 5,
                'permisoid'       => 6,
            ],
            [
                'modulopermisoid' => 25,
                'moduloid'        => 5,
                'permisoid'       => 2,
            ],
            [
                'modulopermisoid' => 26,
                'moduloid'        => 5,
                'permisoid'       => 4,
            ],
            [
                'modulopermisoid' => 27,
                'moduloid'        => 5,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 28,
                'moduloid'        => 5,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 29,
                'moduloid'        => 5,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 30,
                'moduloid'        => 6,
                'permisoid'       => 5,
            ],
            [
                'modulopermisoid' => 31,
                'moduloid'        => 6,
                'permisoid'       => 6,
            ],
            [
                'modulopermisoid' => 32,
                'moduloid'        => 6,
                'permisoid'       => 2,
            ],
            [
                'modulopermisoid' => 33,
                'moduloid'        => 6,
                'permisoid'       => 4,
            ],
            [
                'modulopermisoid' => 34,
                'moduloid'        => 6,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 35,
                'moduloid'        => 6,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 36,
                'moduloid'        => 6,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 37,
                'moduloid'        => 7,
                'permisoid'       => 5,
            ],
            [
                'modulopermisoid' => 38,
                'moduloid'        => 7,
                'permisoid'       => 6,
            ],
            [
                'modulopermisoid' => 39,
                'moduloid'        => 7,
                'permisoid'       => 2,
            ],
            [
                'modulopermisoid' => 40,
                'moduloid'        => 7,
                'permisoid'       => 4,
            ],
            [
                'modulopermisoid' => 41,
                'moduloid'        => 7,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 42,
                'moduloid'        => 7,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 43,
                'moduloid'        => 7,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 44,
                'moduloid'        => 8,
                'permisoid'       => 5,
            ],
            [
                'modulopermisoid' => 45,
                'moduloid'        => 8,
                'permisoid'       => 6,
            ],
            [
                'modulopermisoid' => 46,
                'moduloid'        => 8,
                'permisoid'       => 2,
            ],
            [
                'modulopermisoid' => 47,
                'moduloid'        => 8,
                'permisoid'       => 4,
            ],
            [
                'modulopermisoid' => 48,
                'moduloid'        => 8,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 49,
                'moduloid'        => 8,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 50,
                'moduloid'        => 8,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 51,
                'moduloid'        => 9,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 53,
                'moduloid'        => 9,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 54,
                'moduloid'        => 9,
                'permisoid'       => 4,
            ],
            [
                'modulopermisoid' => 57,
                'moduloid'        => 9,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 61,
                'moduloid'        => 11,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 62,
                'moduloid'        => 12,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 63,
                'moduloid'        => 13,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 64,
                'moduloid'        => 13,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 65,
                'moduloid'        => 10,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 66,
                'moduloid'        => 10,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 67,
                'moduloid'        => 10,
                'permisoid'       => 4,
            ],
            [
                'modulopermisoid' => 68,
                'moduloid'        => 10,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 69,
                'moduloid'        => 12,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 70,
                'moduloid'        => 14,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 71,
                'moduloid'        => 14,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 72,
                'moduloid'        => 15,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 74,
                'moduloid'        => 15,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 75,
                'moduloid'        => 15,
                'permisoid'       => 4,
            ],
            [
                'modulopermisoid' => 78,
                'moduloid'        => 15,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 81,
                'moduloid'        => 16,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 82,
                'moduloid'        => 16,
                'permisoid'       => 2,
            ],
            [
                'modulopermisoid' => 83,
                'moduloid'        => 16,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 84,
                'moduloid'        => 16,
                'permisoid'       => 4,
            ],
            [
                'modulopermisoid' => 85,
                'moduloid'        => 16,
                'permisoid'       => 5,
            ],
            [
                'modulopermisoid' => 86,
                'moduloid'        => 16,
                'permisoid'       => 6,
            ],
            [
                'modulopermisoid' => 87,
                'moduloid'        => 16,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 88,
                'moduloid'        => 17,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 89,
                'moduloid'        => 17,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 90,
                'moduloid'        => 18,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 91,
                'moduloid'        => 18,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 92,
                'moduloid'        => 19,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 93,
                'moduloid'        => 19,
                'permisoid'       => 7,

            ],
            [
                'modulopermisoid' => 94,
                'moduloid'        => 20,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 95,
                'moduloid'        => 20,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 97,
                'moduloid'        => 11,
                'permisoid'       => 12,
            ],
            [
                'modulopermisoid' => 98,
                'moduloid'        => 21,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 99,
                'moduloid'        => 21,
                'permisoid'       => 2,
            ],
            [
                'modulopermisoid' => 100,
                'moduloid'        => 21,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 101,
                'moduloid'        => 21,
                'permisoid'       => 4,
            ],
            [
                'modulopermisoid' => 102,
                'moduloid'        => 21,
                'permisoid'       => 5,
            ],
            [
                'modulopermisoid' => 103,
                'moduloid'        => 21,
                'permisoid'       => 6,
            ],
            [
                'modulopermisoid' => 104,
                'moduloid'        => 21,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 108,
                'moduloid'        => 22,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 109,
                'moduloid'        => 22,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 110,
                'moduloid'        => 11,
                'permisoid'       => 16,
            ],
            [
                'modulopermisoid' => 111,
                'moduloid'        => 23,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 112,
                'moduloid'        => 23,
                'permisoid'       => 2,
            ],
            [
                'modulopermisoid' => 113,
                'moduloid'        => 23,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 114,
                'moduloid'        => 23,
                'permisoid'       => 4,
            ],
            [
                'modulopermisoid' => 115,
                'moduloid'        => 23,
                'permisoid'       => 5,
            ],
            [
                'modulopermisoid' => 116,
                'moduloid'        => 23,
                'permisoid'       => 6,
            ],
            [
                'modulopermisoid' => 117,
                'moduloid'        => 23,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 118,
                'moduloid'        => 24,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 119,
                'moduloid'        => 24,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 120,
                'moduloid'        => 25,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 121,
                'moduloid'        => 25,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 122,
                'moduloid'        => 26,
                'permisoid'       => 17,
            ],
            [
                'modulopermisoid' => 123,
                'moduloid'        => 27,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 124,
                'moduloid'        => 27,
                'permisoid'       => 2,
            ],
            [
                'modulopermisoid' => 125,
                'moduloid'        => 27,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 126,
                'moduloid'        => 27,
                'permisoid'       => 4,
            ],
            [
                'modulopermisoid' => 128,
                'moduloid'        => 27,
                'permisoid'       => 5,
            ],
            [
                'modulopermisoid' => 129,
                'moduloid'        => 27,
                'permisoid'       => 6,
            ],
            [
                'modulopermisoid' => 130,
                'moduloid'        => 27,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 131,
                'moduloid'        => 28,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 133,
                'moduloid'        => 28,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 134,
                'moduloid'        => 28,
                'permisoid'       => 4,
            ],
            [
                'modulopermisoid' => 135,
                'moduloid'        => 28,
                'permisoid'       => 5,
            ],
            [
                'modulopermisoid' => 137,
                'moduloid'        => 28,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 138,
                'moduloid'        => 29,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 139,
                'moduloid'        => 29,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 140,
                'moduloid'        => 30,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 141,
                'moduloid'        => 30,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 142,
                'moduloid'        => 31,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 143,
                'moduloid'        => 31,
                'permisoid'       => 2,
            ],
            [
                'modulopermisoid' => 144,
                'moduloid'        => 31,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 145,
                'moduloid'        => 31,
                'permisoid'       => 4,
            ],
            [
                'modulopermisoid' => 146,
                'moduloid'        => 31,
                'permisoid'       => 5,
            ],
            [
                'modulopermisoid' => 147,
                'moduloid'        => 31,
                'permisoid'       => 6,
            ],
            [
                'modulopermisoid' => 148,
                'moduloid'        => 31,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 149,
                'moduloid'        => 19,
                'permisoid'       => 18,
            ],
            [
                'modulopermisoid' => 150,
                'moduloid'        => 24,
                'permisoid'       => 18,
            ],
            [
                'modulopermisoid' => 151,
                'moduloid'        => 25,
                'permisoid'       => 18,
            ],
            [
                'modulopermisoid' => 152,
                'moduloid'        => 32,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 153,
                'moduloid'        => 32,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 154,
                'moduloid'        => 33,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 155,
                'moduloid'        => 33,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 156,
                'moduloid'        => 34,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 157,
                'moduloid'        => 34,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 158,
                'moduloid'        => 35,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 159,
                'moduloid'        => 35,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 160,
                'moduloid'        => 11,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 161,
                'moduloid'        => 36,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 163,
                'moduloid'        => 36,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 164,
                'moduloid'        => 37,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 166,
                'moduloid'        => 37,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 167,
                'moduloid'        => 37,
                'permisoid'       => 4,
            ],
            [
                'modulopermisoid' => 170,
                'moduloid'        => 37,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 171,
                'moduloid'        => 38,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 172,
                'moduloid'        => 38,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 173,
                'moduloid'        => 39,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 174,
                'moduloid'        => 39,
                'permisoid'       => 2,
            ],
            [
                'modulopermisoid' => 175,
                'moduloid'        => 39,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 176,
                'moduloid'        => 39,
                'permisoid'       => 4,
            ],
            [
                'modulopermisoid' => 177,
                'moduloid'        => 39,
                'permisoid'       => 5,
            ],
            [
                'modulopermisoid' => 178,
                'moduloid'        => 39,
                'permisoid'       => 6,
            ],
            [
                'modulopermisoid' => 179,
                'moduloid'        => 39,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 180,
                'moduloid'        => 39,
                'permisoid'       => 18,
            ],
            [
                'modulopermisoid' => 183,
                'moduloid'        => 41,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 184,
                'moduloid'        => 41,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 185,
                'moduloid'        => 42,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 186,
                'moduloid'        => 42,
                'permisoid'       => 2,
            ],
            [
                'modulopermisoid' => 187,
                'moduloid'        => 42,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 188,
                'moduloid'        => 42,
                'permisoid'       => 4,
            ],
            [
                'modulopermisoid' => 189,
                'moduloid'        => 42,
                'permisoid'       => 5,
            ],
            [
                'modulopermisoid' => 190,
                'moduloid'        => 42,
                'permisoid'       => 6,
            ],
            [
                'modulopermisoid' => 191,
                'moduloid'        => 42,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 192,
                'moduloid'        => 43,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 193,
                'moduloid'        => 44,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 194,
                'moduloid'        => 44,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 195,
                'moduloid'        => 44,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 196,
                'moduloid'        => 45,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 197,
                'moduloid'        => 45,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 198,
                'moduloid'        => 45,
                'permisoid'       => 4,
            ],
            [
                'modulopermisoid' => 199,
                'moduloid'        => 45,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 200,
                'moduloid'        => 43,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 201,
                'moduloid'        => 46,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 202,
                'moduloid'        => 46,
                'permisoid'       => 7,
            ],
            [
                'modulopermisoid' => 203,
                'moduloid'        => 46,
                'permisoid'       => 18,
            ],
            [
                'modulopermisoid' => 204,
                'moduloid'        => 47,
                'permisoid'       => 1,
            ],
            [
                'modulopermisoid' => 205,
                'moduloid'        => 47,
                'permisoid'       => 2,
            ],
            [
                'modulopermisoid' => 206,
                'moduloid'        => 47,
                'permisoid'       => 3,
            ],
            [
                'modulopermisoid' => 207,
                'moduloid'        => 47,
                'permisoid'       => 4,
            ],
            [
                'modulopermisoid' => 208,
                'moduloid'        => 47,
                'permisoid'       => 5,
            ],
            [
                'modulopermisoid' => 209,
                'moduloid'        => 47,
                'permisoid'       => 6,
            ],
            [
                'modulopermisoid' => 210,
                'moduloid'        => 47,
                'permisoid'       => 7,
            ],
        ]);

        DB::table('authmodulopermisos')->update(['created_at' => date_create(), 'updated_at' => date_create()]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
