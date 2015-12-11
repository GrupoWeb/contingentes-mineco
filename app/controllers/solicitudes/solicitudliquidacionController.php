<?php

class solicitudliquidacionController extends BaseController {

	public function index() {
		//retorna datos a la vista
		$certificados = Certificado::getCertificadosPendientesUsuario(Auth::id());
    return View::make('certificados.liquidaciones')
      ->with('certificados', $certificados);
	}

	public function show($id) {
		try {
			//asigna valor de id
			$certificadoid = Crypt::decrypt($id);
		} catch (Exception $e) {
			//muestra mensaje
			Session::flash('message', 'Certificado invalido');
	    Session::flash('type', 'danger');
	    return Redirect::to('solicitudliquidacion');
		}

		//consulta en db segun $certificadoid
		$certificado = Certificado::getCertificado($certificadoid);
		//retorna dato a la vista
		return View::make('certificados.show', ['certificado'=>$certificado]);
	}

	public function store() {
		try {
			//asigna valor del hidden
			$certificadoid = Crypt::decrypt(Input::get('cmbCertificados'));
		} catch (Exception $e) {
			//muestra mensaje si existe error
			Session::flash('message', 'Certificado invalido');
	    Session::flash('type', 'danger');
	    return Redirect::to('solicitudliquidacion');
		}

		//asigna valores a las variables
		$arch   = Input::file('txDocumento');
		$nombre = date('Ymdhis') . mt_rand(1, 1000) . '.' . strtolower($arch->getClientOriginalExtension());
		$res    = $arch->move(public_path() . 'archivos/liquidaciones/' . Auth::id(), $nombre);

		//inserta datos en db
		$solicitud                   = new Solicitudliquidacion;
		$solicitud->usuarioid        = Auth::id();
		$solicitud->certificadoid    = $certificadoid;
    $solicitud->dua              = Input::get('txDua');
    $solicitud->real             = Input::get('txCantidad');
    $solicitud->cif              = Input::get('txCIF');
    $solicitud->documento        = $nombre;
    $solicitud->estado           = 'Pendiente';
    $solicitud->fechaliquidacion = Components::fechaHumanoAMysql(Input::get('txFecha'));
    $solicitud->save();

    //enviar correo
		$usuario     = Authusuario::find($solicitud->usuarioid);
		$empresa     = Empresa::find($usuario->empresaid);
		$empresas    = Usuario::listEmpresaEmails($usuario->empresaid, $usuario->usuarioid);
		$admins      = Usuario::listAdminEmails();
		$certificado = Certificado::find($certificadoid);
    try {
			Mail::send('emails.solicitudliquidacion', array(
				'empresa'     => $empresa->razonsocial,
				'usuario'     => $usuario->nombre,
				'certificado' => $certificado->numerocertificado,
				'partida'     => $certificado->fraccion), function($msg) use ($usuario, $admins, $empresas){
	       	$msg->to($usuario->email)->subject('Solicitud de Liquidación DACE - MINECO');
	       	$msg->cc($empresas);
	       	$msg->bcc($admins);
			});
		} catch (Exception $e) {}

		Session::flash('message', 'Liquidación enviada exitosamente');
    Session::flash('type', 'success');

    //retorna a la vista
    return Redirect::to('solicitudliquidacion');
	}

}