<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationAuthusuariowebservice extends Migration {

	public function up() {
		Schema::create('authwebservice', function(Blueprint $table)
		{
			$table->increments('usuarioid');
			$table->string('email')->unique();
			$table->string('password');
			$table->string('nombre');
			$table->boolean('activo')->default(1);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down() {
		Schema::drop('authwebservice');
	}

}
