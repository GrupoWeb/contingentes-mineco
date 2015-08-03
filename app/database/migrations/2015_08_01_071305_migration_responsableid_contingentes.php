<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationResponsableidContingentes extends Migration {

	public function up() {
		Schema::table('contingentes', function($table){
			$table->integer('responsableid')->unsigned()->default(2)->after('plantillaid');
			$table->foreign('responsableid')->references('usuarioid')->on('authusuarios');
		});
	}

	public function down() {
		Schema::table('contingentes', function($table){
			$table->dropForeign('contingentes_responsableid_foreign');
			$table->dropColumn('responsableid');
		});
	}
}