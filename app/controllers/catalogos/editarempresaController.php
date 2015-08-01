<?php

class editarempresaController extends crudController {
	
	public function index() {
		$dataEmpresa = Empresa::getInfoEmpresa(Auth::user()->empresaid);
	//dd($dataEmpresa);
		return View::make('empresas.edit')->with('data', $dataEmpresa);
	}

	public function store() {
		dd(Input::all());
		
		$pendiente = Solicitudautorizacion::getPendientes(Auth::user()->usuarioid);
		
		if($pendiente <> null) {			
						Session::flash('message', 'Tiene autorizaciones Pendientes');
						Session::flash('type', 'success');
						return Redirect::to('editardatosempresa');
			}else {
						// $user = new Solicitudautorizacion;
						// 	$user->usuarioid 							 = Auth::user()->usuarioid;
						// 	$user->nit 										 = Input::get('txNIT');
						// 	$user->razonsocial 						 = Input::get('txRazonSocial');
						// 	$user->propietario						 = Input::get('txPropietario') ;
						// 	$user->telefono 							 = Input::get('txTelefono');
						// 	$user->fax 										 = Input::get('txFax');
						// 	$user->domiciliofiscal 				 = Input::get('txDomicilioFiscal');
						// 	$user->domiciliocomercial 		 = Input::get('txDomicilioComercial');
						// 	$user->direccionnotificaciones = Input::get('txDireccionNotificaciones');
						// 	$user->encargadoimportaciones  = Input::get('txEncargadoImportaciones');
						// 	$user->codigovupe 						 = Input::get('txVUPE');
						// $user->save();
						// almacenando Archivos
						$files = Input::file('file');
						//dd($files);
						foreach($files as $file) {
							$nombreArchivo = $file->originalName();
							dd($nombreArchivo);
						}
		}
	}
}
