<?php

class usuariosdeempresaController extends crudController {

	public function __construct() {
    //Titulo catalogo
    Crud::setTitulo('Usuarios de empresas');
    //Conexion DB tabla usuarios
    Crud::setTablaId('usuarioid');
    Crud::setTabla('authusuarios');

    Crud::setWhereRaw("rolid IN (". implode(',', Config::get('contingentes.rolempresa')) .")");
    //Definicion de campos enlazado con conexion DB
    Crud::setCampo(array('nombre'=>'Nombre','campo'=>'authusuarios.nombre','reglas' => array('notEmpty'),'reglasmensaje'=>'El nombre es requerido'));
    Crud::setCampo(array('nombre'=>'Email','campo'=>'email','reglas' => array('notEmpty','email'),'reglasmensaje'=>'El email es requerido y debe ser valido'));
    Crud::setCampo(array('nombre'=>'Creado','campo'=>'authusuarios.created_at','tipo'=>'datetime','editable'=>false));
    Crud::setCampo(array('nombre'=>'Activo','campo'=>'authusuarios.activo','tipo'=>'bool'));
    Crud::setCampo(array('nombre'=>'Contraseña','campo'=>'password','tipo'=>'password','show'=>false));

    //permisos para cancerbero
    Crud::setPermisos(Cancerbero::tienePermisosCrud('usuarioempresas'));
  }

  public function edit($id) {
    //id de usuario
    $id      = Crypt::decrypt($id);
    //consulta usuario segun id
    $usuario = Usuario::find($id);

    //Manda a las vista el usuario
    return View::make('usuarios.edit')
      ->with('usuario', $usuario)
      //consulta la empresa segun usuario
      ->with('empresa', Empresa::find($usuario->empresaid));
  }

  public function update($id) {
    //id de usuario
    $id              = Crypt::decrypt($id);
    //consulta usuario segun id
    $usuario         = Usuario::find($id);

    //inserta datos usuario del formulario 
    $usuario->email  = Input::get('email');
    $usuario->nombre = Input::get('txRazonSocial');
    $usuario->activo = Input::get('activo', 0);

    if(Input::get('txPassword') <> '')
      $usuario->password = Hash::make(Input::get('txPassword'));

    //guarda datos tabla
    $usuario->save();

    //inserta datos empresa del formulario 
    $empresa                          = Empresa::find($usuario->empresaid);
    $empresa->nit                     = Input::get('txNIT');
    $empresa->codigovupe              = Input::get('txVupe');
    $empresa->razonsocial             = Input::get('txRazonSocial');
    $empresa->propietario             = Input::get('txPropietario');
    $empresa->telefono                = Input::get('txTelefono');
    $empresa->fax                     = Input::get('txFax');
    $empresa->domiciliofiscal         = Input::get('txDomicilioFiscal');
    $empresa->domiciliocomercial      = Input::get('txDomicilioComercial');
    $empresa->direccionnotificaciones = Input::get('txDireccionNotificaciones');
    $empresa->encargadoimportaciones  = Input::get('txEncargadoImportaciones');
    //guarda datos a la tabla
    $empresa->save();    

    //mensaje
    Session::flash('message', 'Usuario editado exitosamente');
    Session::flash('type', 'success');

    //retorna a la vista
    return Redirect::to('usuarioempresas');
  }
}
