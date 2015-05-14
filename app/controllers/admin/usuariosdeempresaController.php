<?php

class usuariosdeempresaController extends crudController {

	public function __construct() {
    Crud::setTitulo('Usuarios de empresas');
    Crud::setTablaId('usuarioid');
    Crud::setTabla('authusuarios');

    Crud::setWhereRaw("rolid IN (". implode(',', Config::get('contingentes.rolempresa')) .")");

    Crud::setCampo(array('nombre'=>'Nombre','campo'=>'authusuarios.nombre','reglas' => array('notEmpty'),'reglasmensaje'=>'El nombre es requerido'));
    Crud::setCampo(array('nombre'=>'Email','campo'=>'email','reglas' => array('notEmpty','email'),'reglasmensaje'=>'El email es requerido y debe ser valido'));
    Crud::setCampo(array('nombre'=>'Creado','campo'=>'authusuarios.created_at','tipo'=>'datetime','editable'=>false));
    Crud::setCampo(array('nombre'=>'Activo','campo'=>'authusuarios.activo','tipo'=>'bool'));
    Crud::setCampo(array('nombre'=>'Contraseña','campo'=>'password','tipo'=>'password','show'=>false));

    Crud::setPermisos(Cancerbero::tienePermisosCrud('usuarioempresas'));
  }

  public function edit($id) {
    $id      = Crypt::decrypt($id);
    $usuario = Usuario::find($id);

    return View::make('usuarios.edit')
      ->with('usuario', $usuario)
      ->with('empresa', Empresa::find($usuario->empresaid));
  }

  public function update($id) {
    $id              = Crypt::decrypt($id);
    $usuario         = Usuario::find($id);
    $usuario->email  = Input::get('email');
    $usuario->nombre = Input::get('txRazonSocial');
    $usuario->activo = Input::get('activo', 0);

    if(Input::get('txPassword') <> '')
      $usuario->password = Hash::make(Input::get('txPassword'));

    $usuario->save();

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
    $empresa->save();    

    Session::flash('message', 'Usuario editado exitosamente');
    Session::flash('type', 'success');

    return Redirect::to('usuarioempresas');
  }
}
