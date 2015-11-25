<?php

class apiController extends BaseController {

	public function certificado($id) {
		//declaracion de varibles
		$codigoerror = 0;
		$error       = '';
		$url         = '';
		$tm          = 0;
		$fraccion    = '';
		$estado      = '';
		$emision     = '';
		$vencimiento = '';

		//consulta db segun id
		$certificado = Certificado::find($id);
		
		//verifica si certificado existe
		if(!$certificado){
			$codigoerror = 2;
			$error       = 'Certificado no encontrado';
		}

		else {
			//asignacion a la variable
			$url         = url().'/c/'.Crypt::encrypt($id);
			$tm          = $certificado->volumen;
			$fracion     = $certificado->fraccion;
			$estado      = $certificado->anulado == 0 ? 'activo' : 'anulado';
			$emision     = $certificado->fecha;
			$vencimiento = $certificado->fechavencimiento;
		}

		//declaracion de array con las variables
		$response = array(
			'codigoerror'         => $codigoerror,
			'error'               => $error,
			'data'                => array(
			'emision'             => $emision,
			'vencimiento'         => $vencimiento,
			'fraccionarancelaria' => $fraccion,
			'tm'                  => $tm,
			'pdf'                 => $url, 
			'estado'              => $estado));

		//retorna con los datos en json
		return Response::json($response);
	}

	public function empresavigente(){
		$response = array('codigoerror'=>0, 'error'=>'', 'data' => array());
		
		//verifica nit
		if (!Input::has('nit')) {
			//ingreso de valores al areglo
			$response['codigoerror'] = 1;
			$response['error']       = 'El parámetro nit es requerido';
			//retorna datos en json
			return Response::json($response);
		}

		//colsulta nit en db
		$empresa  = Empresa::getActivaNit(Input::get('nit'));
		if (!$empresa) {
			//ingreso de valores al areglo
			$response['codigoerror'] = 2;
			$response['error']       = 'Número de NIT no encontrado';
			//retorna datos en json
			return Response::json($response);
		}

		//consulta den db segun $empresaid
		$tratados = Empresacontingente::getTratadosEmpresa($empresa->empresaid);

		//ingreso de datos al areglo
		$response['data']	= array(
			'vigente'  => $empresa->activo,
			'redirect' => Config::get('website.url') . '/signup',
			'tratados' => $tratados
		);
		//retorna datos en json
		return Response::json($response);
	}

	public function listadocontingentes(){
		$response = array('codigoerror'=>0, 'error'=>'', 'data' => array());

		//condicion nit o tratadoid
		if (!Input::has('nit') || (!Input::has('tratadoid')))  {
			//ingreso de valores al areglo
			$response['codigoerror'] = 1;
			$response['error']       = 'Los parámetros nit y tratadoid son requeridos';
			//retorna datos en json
			return Response::json($response);
		}

		//consulta en db segun nit
		$empresa  = Empresa::getActivaNit(Input::get('nit'));
		//verifica empresa
		if (!$empresa) {
			//ingreso de valores al areglo
			$response['codigoerror'] = 2;
			$response['error']       = 'Número de NIT no encontrado';

			//retorna dato en json
			return Response::json($response);
		}

		//consulta en db segun empresa y tratadoid
		$contingentes = Empresacontingente::contingentesEmpresaTratado($empresa->empresaid , Input::get('tratadoid'));
		$response['data'] = $contingentes;
		//retona los datos en json
		return Response::json($response);
	}

	public function partidascontingente(){
		$response = array('codigoerror'=>0, 'error'=>'', 'data' => array());
		
		//verifica contingenteid
		if (!Input::has('contingenteid'))  {
			//ingreso de valores al areglo
			$response['codigoerror'] = 1;
			$response['error']       = 'El parámetro contingenteid es requerido';
			//retorna los datos en json
			return Response::json($response);
		}

		//consulta en db segun contingenteid
		$partidas         = Contingentepartida::getPartidas(Input::get('contingenteid'));
		$response['data'] = $partidas;
		//retorna datos en json
		return Response::json($response);
	}

	public function cuentacorriente(){
		$response = array('codigoerror'=>0, 'error'=>'', 'data' => array());

		//condiciona nit y contigente id
		if (!Input::has('nit') || (!Input::has('contingenteid')))  {
			//ingreso de valores al areglo
			$response['codigoerror'] = 1;
			$response['error']       = 'Los parámetros nit y contingenteid son requeridos';
			//retorna los dato en json
			return Response::json($response);
		}

		//consulta db segun nit
		$empresa  = Empresa::getActivaNit(Input::get('nit'));

		//verifica si existe nit
		if (!$empresa) {
			$response['codigoerror'] = 2;
			$response['error']       = 'Número de NIT no encontrado';
			return Response::json($response);
		}
		//consulta en db segun empresaid y contingenteid
		$saldo = Movimiento::getSaldo($empresa->empresaid, Input::get('contingenteid'));
		
		$response['data'] = $saldo;
		//retorna los dato en json
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
		
		if(!Input::has('dace')) {
			//$ret['error'] = 'Parámetros incompletos';
			return json_encode($ret);
		}

		try {
			$json = json_decode(Input::get('dace'));	
		} catch (Exception $e) {
			//$ret['error'] = 'JSON inválido';
			return json_encode($ret);
		}
		

		if (!property_exists($json, 'keycode')) {
			//$ret['error'] = 'Datos invalidos';
			return json_encode($ret);
		}

		$corr = $json->correlativo;
		$corr = substr($corr, 1);
		$cert = Certificado::getCertificado((int)$corr);
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
			$ret['codigo_vupe']         = $cert->codigovupe;
		}
		else {
			//$ret['error'] = 'Registro no encontrado';
		}	
		return json_encode($ret); 
	}
}