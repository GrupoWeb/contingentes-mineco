<?php

class webserviceController extends BaseController {

	public function certificado($emisor, $id) {
		$url = 'http://contingentes.localdev/c/'.Crypt::encrypt(1);

		$response = array(
			'codigoerror' => 0,
			'error'       => '',
			'data'        => array('emision'       => date('d-m-Y H:i:s'),
											 'vencimiento'         => date('d-m-Y H:i:s'),
											 'fraccionarancelaria' => '0001.110.201',
											 'tm'                  => 4.55,
											 'pdf'                 => $url, 
											 'estado'              => 'activo'));

		return Response::json($response);
	}
}