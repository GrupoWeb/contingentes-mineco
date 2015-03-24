<?php

class Usuario extends Eloquent {

	protected $table      = 'authusuarios';
	protected $primaryKey = 'usuarioid';

	public static function listAdminEmails() {
		return DB::table('authusuarios')
			->whereIn('rolid', Config::get('contingentes.roladmin'))
			->lists('email');
	}

	public static function listUsuariosEmpresa($aEmpresaId) {
		return DB::table('authusuarios')
			->where('empresaid', $aEmpresaId)
			->lists('usuarioid');
	}

	public static function listEmpresaEmails($aEmpresaId, $aUsuarioId) {
		return DB::table('authusuarios')
			->where('empresaid', $aEmpresaId)
			->where('usuarioid', '<>', $aUsuarioId)
			->lists('email');
	}

}
