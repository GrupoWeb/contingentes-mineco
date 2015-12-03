<?php

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Noticia extends Eloquent {
	
	use SluggableTrait;

  protected $sluggable = array(
    'build_from'      => null,
    'save_to'         => 'slug',
    'separator'       => '-',
    'unique'          => true,
  );

	protected $table     = 'noticias';
	protected $primryKey = 'noticiaid';

	public static function getNoticias() {
		return DB::table('noticias')
			->select('titulo', 'contenido', 'imagen', 'documento', 'slug',
				DB::raw('DATE_FORMAT(updated_at, "%d-%m-%Y") AS fecha'))
			->orderBy('updated_at', 'desc')
			->get();
	}

	public static function getNoticiaFromSlug($aSlug) {
		return DB::table('noticias')
			->select('titulo', 'contenido', 'imagen', 'documento',
				DB::raw('DATE_FORMAT(updated_at, "%d-%m-%Y") AS fecha'))
			->where('slug', $aSlug)
			->first();
	}
}