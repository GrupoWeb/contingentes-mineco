<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationContingentesNormativo extends Migration {

	public function up() {
		Schema::table('contingentes', function($table){
			$table->string('normativo')->after('textocertificado')->nullable()->default(null);
		});

		Schema::table('tratados', function($table){
			$table->string('normativo')->after('nombrecorto')->nullable()->default(null);
		});
	}

	public function down() {
		Schema::table('contingentes', function($table){
			$table->dropColumn('normativo');
		});


		Schema::table('tratados', function($table){
			$table->dropColumn('normativo');
		});
	}

}
