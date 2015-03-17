<?php

class Usuario extends Eloquent {

	protected $table      = 'authusuarios';
	protected $primaryKey = 'usuarioid';

	public static function listAdminEmails() {
		return DB::table('authusuarios')
			->whereIn('rolid', Config::get('contingentes.roladmin'))
			->lists('email');
	}

}
