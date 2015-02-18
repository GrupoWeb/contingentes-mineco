<?php

class webserviceController extends BaseController {

	public function certificado($emisor, $id) {
		$codigoerror = 0;
		$error       = '';
		$url         = '';
		$tm          = 0;
		$fraccion    = '';
		$estado      = '';
		$emision     = '';
		$vencimiento = '';

		if($emisor <> '76c9bbd147140e0a59db65e770d7b4aa') {
			$codigoerror = 1;
			$error       = 'El emisor no es valido';
		}

		else {
			$certificado = Certificado::find($id);
			
			if(!$certificado){
				$codigoerror = 2;
				$error       = 'Certificado no encontrado';
			}

			else {
				$url         = 'http://contingentes.cs.com.gt:8000/c/'.Crypt::encrypt($id);
				$tm          = $certificado->volumen;
				$fracion     = $certificado->fraccion;
				$estado      = $certificado->anulado == 0 ? 'activo' : 'anulado';
				$emision     = $certificado->fecha;
				$vencimiento = $certificado->fechavencimiento;
			}
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
}