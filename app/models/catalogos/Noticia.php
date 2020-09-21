<?php

use Cviebrock\EloquentSluggable\SluggableTrait;

class Noticia extends Eloquent
{

    use SluggableTrait;

    protected $sluggable = [
        'build_from' => null,
        'save_to'    => 'slug',
        'separator'  => '-',
        'unique'     => true,
    ];

    protected $table      = 'noticias';
    protected $primaryKey = 'noticiaid';

    public static function getNoticias()
    {
        return self::select('titulo', 'contenido', 'imagen', 'documento', 'slug',
            DB::raw('DATE_FORMAT(updated_at, "%d-%m-%Y") AS fecha'))
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public static function getNoticiaFromSlug($aSlug)
    {
        return self::select('titulo', 'contenido', 'imagen', 'documento',
            DB::raw('DATE_FORMAT(updated_at, "%d-%m-%Y") AS fecha'))
            ->where('slug', $aSlug)
            ->first();
    }
}
