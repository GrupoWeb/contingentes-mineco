<?php

class paisesController extends crudController
{
    public function __construct()
    {
        //funsion exportar .xls
        Crud::setExport(true);
        //titulo catalogo
        Crud::setTitulo('Países');
        //conexion db
        Crud::setTablaId('paisid');
        Crud::setTabla('paises');

        //define campos para la informacion de la conexion db
        Crud::setCampo(['nombre' => 'Nombre', 'campo' => 'nombre']);
        Crud::setCampo(['nombre' => 'Código', 'campo' => 'codigo']);

        //permisos cancerbero
        Crud::setPermisos(Cancerbero::tienePermisosCrud('paises'));
    }
}
