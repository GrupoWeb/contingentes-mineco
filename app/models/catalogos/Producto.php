<?php

class Producto extends Eloquent
{
    protected $primaryKey = 'productoid';
    protected $guarded    = ['id'];

    public function unidad()
    {
        return $this->hasOne(Unidadesmedida::class, 'unidadmedidaid', 'unidadmedidaid');
    }

    public static function getProductos()
    {
        return self::select('nombre', 'productoid')
            ->orderBy('nombre')
            ->where('activo', 1)
            ->get();
    }

    public static function getNombre($aProductoId)
    {
        return self::where('productoid', $aProductoId)
            ->pluck('nombre');
    }
}
