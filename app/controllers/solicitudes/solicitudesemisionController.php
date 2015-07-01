<?php
class solicitudesemisionController extends crudController {

	public function __construct() {
		Crud::setExport(false);
		Crud::setSearch(false);
		Crud::setTitulo('Solicitudes pendientes - Emisión');
		Crud::setTabla('solicitudesemision');
		Crud::setTablaId('solicitudemisionid');
		
		Crud::setLeftJoin('authusuarios AS u', 'solicitudesemision.usuarioid', '=', 'u.usuarioid');
		Crud::setLeftJoin('empresas AS e', 'u.empresaid', '=', 'e.empresaid');
		Crud::setLeftJoin('periodos AS p', 'solicitudesemision.periodoid', '=', 'p.periodoid');
		Crud::setLeftJoin('contingentes AS c', 'p.contingenteid', '=', 'c.contingenteid');
		Crud::setLeftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid');
		Crud::setLeftJoin('productos AS d', 'c.productoid', '=', 'd.productoid');

		Crud::setWhere('estado', 'Pendiente');

		$tselected = Session::get('tselected');
		if($tselected <> 0) {
			Crud::setWhere('c.tratadoid', $tselected);
			Crud::setTitulo('Solicitudes pendientes - Emisión - '.Tratado::getNombre($tselected));
		}

		Crud::setCampo(array('nombre'=>'Usuario','campo'=>'u.nombre'));
		Crud::setCampo(array('nombre'=>'Empresa','campo'=>'e.razonsocial'));
		Crud::setCampo(array('nombre'=>'Tratado','campo'=>'t.nombrecorto'));
		Crud::setCampo(array('nombre'=>'Producto','campo'=>'d.nombre'));
		Crud::setCampo(array('nombre'=>'Fecha de solicitud','campo'=>'solicitudesemision.created_at', 'tipo'=>'datetime'));
		Crud::setCampo(array('nombre'=>'Monto Solicitado','campo'=>'solicitado','tipo'=>'numeric', 'decimales'=>4,'class'=>'text-right'));

		Crud::setPermisos(Cancerbero::tienePermisosCrud('solicitudespendientes.emision'));
	}

	public function edit($id) {
		$solicitud 			= Emisionpendiente::getSolicitudPendiente(Crypt::decrypt($id));
		$requerimientos = Solicitudemisionrequerimiento::getEmisionRequerimientos(Crypt::decrypt($id));

		return View::make('solicitudespendientes/emisiones')
			->with('solicitud',$solicitud)
			->with('requerimientos',$requerimientos);
	}

	public function store() {
		$elID = Crypt::decrypt(Input::get('id'));

		if(!Auth::user()->certificado || Auth::user()->certificado == '' || !Auth::user()->firma || Auth::user()->firma == '') {
			Session::flash('type','danger');
			Session::flash('message','Imposible procesar solicitud ya que no se ha encontrado firma para tu usuario.');

			return Redirect::route('solicitudespendientes.emision.index');
		}


		if(Input::has('btnAutorizar')) {
			$cantidad   = Input::get('txCantidad');
			$comentario = Input::get('txObservaciones');
			
			//TRANSACTION ===
			$result = DB::transaction(function() use ($elID, $cantidad, $comentario) {
				$emision                = Emisionpendiente::find($elID);
				$emision->emitido       = $cantidad;
				$emision->observaciones = $comentario;
				$emision->estado        = 'Aprobada';
				$res =	$emision->save();
				if (!$res) return false;

				$info = Emisionpendiente::getSolicitudPendiente($elID);

				$letras = '';
				try {
					$objeto = new Numeroaletras($cantidad);
					$letras = $objeto->getLetras();	
				} catch (Exception $e) {
					$letras = Components::numeroALetras($cantidad,null, 2);
				}
				
				$certificado                     = new Certificado;
				$certificado->tratado            = $info->tratadolargo;
				$certificado->producto           = $info->producto;
				$certificado->usuarioid          = $emision->usuarioid;
				$certificado->nombre             = $info->nombre;
				$certificado->direccion          = $info->domiciliofiscal;
				$certificado->nit                = $info->nit;
				$certificado->codigovupe         = $info->codigovupe;
				$certificado->telefono           = $info->telefono;
				$certificado->volumen            = $cantidad;
				$certificado->volumenletras      = $letras;
				$certificado->fraccion           = $info->fraccion;
				$certificado->paisid             = $info->paisid;
				$certificado->variacion          = $info->variacion;
				$certificado->tratadodescripcion = $info->textocertificado;
				$certificado->fecha              = date_create();
				$certificado->fechavencimiento   = $info->vencimiento;
				$res = $certificado->save();
				if (!$res) return false;

				$p           = Periodo::where('periodoid', $emision->periodoid)->pluck('contingenteid');
				$c           = Certificado::find($certificado->certificadoid);
				$contingente = Contingente::find($p);	
				$tipoc       = $contingente->tipocorrelativoid;

				if($tipoc==1) //Correlativo
					$c->numerocertificado = $certificado->certificadoid;
				else if($tipoc==2) //CA-AXXXXXX
					$c->numerocertificado = 'CA-A'.str_pad($certificado->certificadoid, 6, '0', STR_PAD_LEFT);
				else //CH-AXXXXXX
					$c->numerocertificado = 'CH-A'.str_pad($certificado->certificadoid, 6, '0', STR_PAD_LEFT);
				
				$c->save();

				$movimiento                   = new Movimiento;
				$movimiento->periodoid        = $emision->periodoid;
				$movimiento->usuarioid        = $emision->usuarioid;
				$movimiento->certificadoid    = $certificado->certificadoid;
				$movimiento->cantidad         = ($cantidad * -1);
				$movimiento->comentario       = $comentario;
				$movimiento->tipomovimientoid = DB::table('tiposmovimiento')->where('nombre', 'Certificado')->pluck('tipomovimientoid');
				$movimiento->created_by       = Auth::id();
				$res = $movimiento->save();
				if (!$res) return false;
				return array('emision'=>$emision, 'certificado'=>$certificado);
			});

			//====

			$admins = Usuario::listAdminEmails();

			if($result) {
				$usuario  = Authusuario::find($result['emision']->usuarioid);
				$email    = $usuario->email;
				$emision  = Emisionpendiente::find($elID);
				$empresas = Usuario::listEmpresaEmails($usuario->empresaid, $usuario->usuarioid);
				$producto = $result['emision']->producto;

				Session::flash('type','success');
				Session::flash('message','La solicitud de emisión fue procesada correctamente');

				try {
					Mail::send('emails/solicitudemisionresultado', array(
						'nombre'        => $usuario->nombre,
						'fecha'         => $result['emision']->created_at,
						'url'           => url('c/'.Crypt::encrypt($result['certificado']->certificadoid)),
						'estado'        => 'Aprobada',
						'contingente'   => $producto,
						'solicitado'    => $emision->solicitado,
						'emitido'       => $cantidad,
						'observaciones' => Input::get('txObservaciones')), function($msg) use ($email, $admins, $empresas){
			       	$msg->to($email)->subject('Certificado DACE - MINECO');
			       	$msg->cc($empresas);
			       	$msg->bcc($admins);
					});
				} catch (Exception $e) {}
			}
			else {
				Session::flash('type','warning');
				Session::flash('message','Ocurrió un error al intentar autorizar, intente de nuevo.');
			}
		}

		else {
			$emision                = Emisionpendiente::find($elID);
			$emision->observaciones = Input::get('txObservaciones');
			$emision->estado        = 'Rechazada';
			$result                 = $emision->save();

			if($result) {
				Session::flash('type','success');
				Session::flash('message','La solicitud de inscripción fue rechazada');

				$usuario  = Authusuario::find($emision->usuarioid);
				$email    = $usuario->email;
				$empresas = Usuario::listEmpresaEmails($usuario->empresaid, $usuario->usuarioid);

				try {
					Mail::send('emails/solicitudemisionresultado', array(
						'nombre'        => $usuario->nombre,
						'fecha'         => $emision->created_at,
						'estado'        => 'Rechazada',
						'solicitado'    => $emision->solicitado,
						'emitido'       => 0,
						'observaciones' => Input::get('txObservaciones')), function($msg) use ($email, $admins, $empresas){
			       	$msg->to($email)->subject('Solicitud de Emisión DACE - MINECO');
			       	$msg->cc($empresas);
			       	$msg->bcc($admins);
					});
				} catch (Exception $e) {}
			}
			else {
				Session::flash('type','warning');
				Session::flash('message','Ocurrió un error al intentar rechazar, intente de nuevo.');
			}
		}
		
		return Redirect::route('solicitudespendientes.emision.index');
	}
}