<?php

class apiController extends BaseController {

	public function certificado($id) {
		$codigoerror = 0;
		$error       = '';
		$url         = '';
		$tm          = 0;
		$fraccion    = '';
		$estado      = '';
		$emision     = '';
		$vencimiento = '';

		$certificado = Certificado::find($id);
		
		if(!$certificado){
			$codigoerror = 2;
			$error       = 'Certificado no encontrado';
		}

		else {
			$url         = url().'/c/'.Crypt::encrypt($id);
			$tm          = $certificado->volumen;
			$fracion     = $certificado->fraccion;
			$estado      = $certificado->anulado == 0 ? 'activo' : 'anulado';
			$emision     = $certificado->fecha;
			$vencimiento = $certificado->fechavencimiento;
		}

		$response = array(
			'codigoerror' => $codigoerror,
			'error'       => $error,
			'data'        => array(
				'emision'             => $emision,
				'vencimiento'         => $vencimiento,
				'fraccionarancelaria' => $fraccion,
				'tm'                  => $tm,
				'pdf'                 => $url, 
				'estado'              => $estado));

		return Response::json($response);
	}

	public function empresavigente(){
		$response = array('codigoerror'=>0, 'error'=>'', 'data' => array());
		if (!Input::has('nit')) {
			$response['codigoerror'] = 1;
			$response['error']       = 'El parámetro nit es requerido';
			return Response::json($response);
		}

		$empresa  = Empresa::getActivaNit(Input::get('nit'));
		if (!$empresa) {
			$response['codigoerror'] = 2;
			$response['error']       = 'Número de NIT no encontrado';
			return Response::json($response);
		}

		$tratados = Empresacontingente::getTratadosEmpresa($empresa->empresaid);

		$response['data']	= array(
			'vigente'  => $empresa->activo,
			'redirect' => Config::get('website.url') . '/signup',
			'tratados' => $tratados
		);
		return Response::json($response);
	}

	public function listadocontingentes(){
		$response = array('codigoerror'=>0, 'error'=>'', 'data' => array());
		if (!Input::has('nit') || (!Input::has('tratadoid')))  {
			$response['codigoerror'] = 1;
			$response['error']       = 'Los parámetros nit y tratadoid son requeridos';
			return Response::json($response);
		}

		$empresa  = Empresa::getActivaNit(Input::get('nit'));
		if (!$empresa) {
			$response['codigoerror'] = 2;
			$response['error']       = 'Número de NIT no encontrado';
			return Response::json($response);
		}

		$contingentes = Empresacontingente::contingentesEmpresaTratado($empresa->empresaid , Input::get('tratadoid'));
		$response['data'] = $contingentes;
		return Response::json($response);
	}

	public function partidascontingente(){
		$response = array('codigoerror'=>0, 'error'=>'', 'data' => array());
		if (!Input::has('contingenteid'))  {
			$response['codigoerror'] = 1;
			$response['error']       = 'El parámetro contingenteid es requerido';
			return Response::json($response);
		}

		$partidas         = Contingentepartida::getPartidas(Input::get('contingenteid'));
		$response['data'] = $partidas;
		return Response::json($response);
	}

	public function cuentacorriente(){
		$response = array('codigoerror'=>0, 'error'=>'', 'data' => array());
		if (!Input::has('nit') || (!Input::has('contingenteid')))  {
			$response['codigoerror'] = 1;
			$response['error']       = 'Los parámetros nit y contingenteid son requeridos';
			return Response::json($response);
		}

		$empresa  = Empresa::getActivaNit(Input::get('nit'));
		if (!$empresa) {
			$response['codigoerror'] = 2;
			$response['error']       = 'Número de NIT no encontrado';
			return Response::json($response);
		}
		$saldo = Movimiento::getSaldo($empresa->usuarioid, Input::get('contingenteid'));
		
		$response['data'] = $saldo;
		return Response::json($response);
	}

	public function solicitudasignacion(){

	}

	public function solicitudemision(){

	}

}