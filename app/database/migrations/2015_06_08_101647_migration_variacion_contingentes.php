<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationVariacionContingentes extends Migration {

	public function up() {
		Schema::table('contingentes', function($table) {
			$table->integer('variacion')->after('plantillaid')->default(0);
		});

		DB::unprepared('UPDATE contingentes AS c SET variacion = (SELECT variacion FROM tratados AS t where t.tratadoid = c.tratadoid)');

		Schema::table('tratados', function($table) {
			$table->dropColumn('variacion');
		});
	}

	public function down() {
		Schema::table('tratados', function($table) {
			$table->integer('variacion')->after('mesesvalidez')->default(0);
		});

		DB::unprepared('UPDATE tratados AS t SET variacion = (SELECT variacion FROM contingentes AS c where c.tratadoid = t.tratadoid LIMIT 1)');

		Schema::table('contingentes', function($table) {
			$table->dropColumn('variacion');
		});
	}

}
