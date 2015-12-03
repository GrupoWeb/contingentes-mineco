<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationSlugNoticias extends Migration {

	public function up() {
		Schema::table('noticias', function($table) {
			$table->string('slug')->after('titulo');
		});
	}

	public function down() {
		Schema::table('noticias', function($table) {
			$table->dropColumn('slug');
		});
	}
}