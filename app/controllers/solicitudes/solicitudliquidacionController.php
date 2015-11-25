<?php

class solicitudliquidacionController extends BaseController {

	public function index() {
		$certificados = Certificado::getCertificadosPendientesUsuario(Auth::id());
    return View::make('certificados.liquidaciones')
      ->with('certificados', $certificados);
	}

	public function show($id) {
		try {
			$certificadoid = Crypt::decrypt($id);
		} catch (Exception $e) {
			Session::flash('message', 'Certificado invalido');
	    Session::flash('type', 'danger');
	    return Redirect::to('solicitudliquidacion');
		}

		$certificado = Certificado::getCertificado($certificadoid);
		return View::make('certificados.show', ['certificado'=>$certificado]);
	}

	public function store() {
		try {
			$certificadoid = Crypt::decrypt(Input::get('cmbCertificados'));
		} catch (Exception $e) {
			Session::flash('message', 'Certificado invalido');
	    Session::flash('type', 'danger');
	    return Redirect::to('solicitudliquidacion');
		}

		$arch   = Input::file('txDocumento');
		$nombre = date('Ymdhis') . mt_rand(1, 1000) . '.' . strtolower($arch->getClientOriginalExtension());
		$res    = $arch->move(public_path() . '/liquidaciones/' . Auth::id(), $nombre);

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
		$empresa     = Empresa::fing($usuario->empresaid);
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

		Session::flash('message', 'Certificado liquidado exitosamente');
    Session::flash('type', 'success');

    return Redirect::to('solicitudliquidacion');
	}

}