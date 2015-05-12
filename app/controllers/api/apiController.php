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
		//esto esta de mas
	}

	public function solicitudemision(){

	}

	public function vupeLegacy(){
		$ret = ['licencia'=>'-','fecha_emision'=>null, 'fecha_vencimiento'=>null, 'toneladasmetricas'=>null,
			'fraccionarancelaria'=>null, 'codigo_vupe'=>null];

		$json = json_decode(Input::get('dace'));

		if (!property_exists($json, 'keycode')) {
			//$ret['error'] = 'Datos invalidos';
			return json_encode($ret);
		}

		$cert = Certificado::getCertificado((int)$json->correlativo);
		if ($cert) {
			$nit = str_replace('-', '', trim($cert->nit));
			$nitclient = str_replace('-', '', trim($json->nit));
			if($nit<>$nitclient) {
				//$ret['error'] = 'Cliente no coincide';
				return json_encode($ret);
			}

			$fraccion = explode(' ', $cert->fraccion);
			$ret['licencia']            = $cert->numerocertificado;
			$ret['fecha_emision']       = $cert->fechamy;
			$ret['fecha_vencimiento']   = $cert->fechavencimientomy;
			$ret['toneladasmetricas']   = $cert->volumen;
			$ret['fraccionarancelaria'] = $fraccion[0] . "\r\n";
			$ret['codigo_vupe']         = '123';
		}
		else {
			//$ret['error'] = 'Registro no encontrado';
		}	
		return json_encode($ret); 
	}
}