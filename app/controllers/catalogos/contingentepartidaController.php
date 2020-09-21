<?php

class contingentepartidaController extends crudController
{

    public function __construct()
    {
        //captura id y consulta db
        $id     = Crypt::decrypt(Input::get('contingente'));
        $nombre = Contingente::getNombre($id);

        //funcion exporta .xls
        Crud::setExport(true);
        //desactiva buscador
        Crud::setSearch(false);
        //titulo de catalogo
        Crud::setTitulo($nombre->nombre . ' - Partidas Arancelarias');

        //conexion db
        Crud::setTablaId('partidaid');
        Crud::setTabla('contingentepartidas');

        //consulta segun id
        Crud::setWhere('contingenteid', $id);
        //definicion de campos con la conexion de la tabla
        Crud::setCampo(['nombre' => 'Nombre', 'campo' => 'nombre', 'tipo' => 'string', 'reglas' => ['notEmpty'], 'reglasmensaje' => 'El nombre es requerido']);
        Crud::setCampo(['nombre' => 'Partida', 'campo' => 'partida', 'tipo' => 'string', 'reglas' => ['notEmpty'], 'reglasmensaje' => 'La partida es requerida']);
        Crud::setCampo(['nombre' => 'Código cuota', 'campo' => 'codigo_cuota', 'tipo' => 'string', 'reglas' => ['notEmpty'], 'reglasmensaje' => 'El código cuota es requerido']);
        Crud::setCampo(['nombre' => 'Código adicional', 'campo' => 'codigo_adicional', 'tipo' => 'string']);
        Crud::setCampo(['nombre' => 'Activa', 'campo' => 'activa', 'tipo' => 'bool']);

        //conservar id
        Crud::setHidden(['campo' => 'contingenteid', 'valor' => $id]);

        //permisos cancerbero
        Crud::setPermisos(Cancerbero::tienePermisosCrud('contingentes'));
    }
}
