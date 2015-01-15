<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationPasosContingente extends Migration {

	public function up() {
		Schema::table('contingentes', function(Blueprint $table) {
			$table->dropColumn('mesesvalido');
			$table->tinyinteger('asignacion')->unsigned()->default(0)->after('productoid');
		});
	}

	public function down() {
		Schema::table('contingentes', function(Blueprint $table) {
			$table->dropColumn('asignacion');
			$table->integer('mesesvalido')->unsigned()->nullable()->after('tipotratadoid');
		});
	}

}
