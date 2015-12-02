<?php

class Noticia extends Eloquent {
	protected $table     = 'noticias';
	protected $primryKey = 'noticiaid';

	public static function getNoticias() {
		return DB::table('noticias')
			->select('titulo', 'contenido', 'imagen', 'documento',
				DB::raw('DATE_FORMAT(updated_at, "%d-%m-%Y") AS fecha'))
			->orderBy('updated_at', 'desc')
			->get();
	}
}