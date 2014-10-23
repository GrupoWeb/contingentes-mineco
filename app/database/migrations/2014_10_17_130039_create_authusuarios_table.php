<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuthusuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('authusuarios', function(Blueprint $table)
		{
			$table->increments('usuarioid');
			$table->string('email')->unique();
			$table->string('password');
			$table->integer('rolid')->unsigned()->index('authusuarios_rolid_foreign');
			$table->string('nombre');
			$table->boolean('activo')->default(1);
			$table->boolean('cambiopassword')->default(1);
			$table->boolean('notificar')->default(0);
			$table->string('remember_token')->nullable();
			$table->string('twostepsecret')->nullable();
			$table->string('facebookid')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('authusuarios');
	}

}
