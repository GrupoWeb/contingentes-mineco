<?php
class solicitudesemisionController extends crudController {

	public function __construct() {
		//funcion exporta .xls
		Crud::setExport(false);
		//funcion buscar
		Crud::setSearch(false);
		//titulo catalogo
		Crud::setTitulo('Solicitudes pendientes - Emisión');

		//conexion sn a la tabla
		Crud::setTabla('solicitudesemision');
		Crud::setTablaId('solicitudemisionid');
		
		//relacion entre tablas
		Crud::setLeftJoin('authusuarios AS u', 'solicitudesemision.usuarioid', '=', 'u.usuarioid');
		Crud::setLeftJoin('empresas AS e', 'u.empresaid', '=', 'e.empresaid');
		Crud::setLeftJoin('periodos AS p', 'solicitudesemision.periodoid', '=', 'p.periodoid');
		Crud::setLeftJoin('contingentes AS c', 'p.contingenteid', '=', 'c.contingenteid');
		Crud::setLeftJoin('solicitudemisionpartidas AS emp', 'solicitudesemision.solicitudemisionid', '=', 'emp.solicitudemisionid');
		Crud::setLeftJoin('contingentepartidas AS cp', 'emp.partidaid', '=', 'cp.partidaid');
		Crud::setLeftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid');
		Crud::setLeftJoin('productos AS d', 'c.productoid', '=', 'd.productoid');

		//condicion db
		Crud::setWhere('estado', 'Pendiente');

		//asigna valor de session y condiciona db
		$tselected = Session::get('tselected');
		if($tselected <> 0) {
			Crud::setWhere('c.tratadoid', $tselected);
			Crud::setTitulo('Solicitudes pendientes - Emisión - '.Tratado::getNombre($tselected));
		}

		//definicio de campos con datos de la conexion db
		Crud::setCampo(array('nombre'=>'Usuario','campo'=>'u.nombre'));
		Crud::setCampo(array('nombre'=>'Empresa','campo'=>'e.razonsocial'));
		Crud::setCampo(array('nombre'=>'Tratado','campo'=>'t.nombrecorto'));
		Crud::setCampo(array('nombre'=>'Fraccion','campo'=>'cp.partida'));
		Crud::setCampo(array('nombre'=>'Producto','campo'=>'d.nombre'));
		Crud::setCampo(array('nombre'=>'Fecha de solicitud','campo'=>'solicitudesemision.created_at', 'tipo'=>'datetime'));
		Crud::setCampo(array('nombre'=>'Monto Solicitado','campo'=>'solicitado','tipo'=>'numeric', 'decimales'=>4,'class'=>'text-right'));

		//permisos cancerbero
		Crud::setPermisos(Cancerbero::tienePermisosCrud('solicitudespendientes.emision'));
	}

	public function edit($id) {
		//captura id  y consulta en db segun id
		$solicitud 			= Emisionpendiente::getSolicitudPendiente(Crypt::decrypt($id));
		$requerimientos = Solicitudemisionrequerimiento::getEmisionRequerimientos(Crypt::decrypt($id));
		//trae objeto segun usuarioid
		$usuario        = Usuario::find($solicitud->usuarioid);
		//asigna valores de query
		$query          = DB::select(DB::raw('SELECT getSaldoPeriodo('.$solicitud->periodoid.', '.$usuario->empresaid.') AS disponible'));
		$disponible     = $query[0]->disponible;

		//retorna datos a la vista
		return View::make('solicitudespendientes/emisiones')
			->with('solicitud',$solicitud)
			->with('requerimientos',$requerimientos)
			->with('disponible', $disponible);
	}

	public function store() {
		//captura id del hidden
		$elID = Crypt::decrypt(Input::get('id'));

		//verifica usuario
		if(!Auth::user()->certificado || Auth::user()->certificado == '' || !Auth::user()->firma || Auth::user()->firma == '') {
			Session::flash('type','danger');
			Session::flash('message','Imposible procesar solicitud ya que no se ha encontrado firma para tu usuario.');

			return Redirect::route('solicitudespendientes.emision.index');
		}

		//condiciona valares del formulario
		if(Input::has('btnAutorizar')) {
			$cantidad   = Input::get('txCantidad');
			$comentario = Input::get('txObservaciones');
			$emision    = Emisionpendiente::find($elID);
			$usuario    = Usuario::find($emision->usuarioid);
			$query      = DB::select(DB::raw('SELECT getSaldoPeriodo('.$emision->periodoid.', '.$usuario->empresaid.') AS disponible'));
			$disponible = $query[0]->disponible;

			/*if($cantidad > $disponible){
				Session::flash('type','danger');
				Session::flash('message','No es posible procesar la solicitud ya que el monto disponible no es suficiente');
				return Redirect::route('solicitudespendientes.asignacion.index');
			}*/
			
			//TRANSACTION ===
			//insertar datos en db 
			$result = DB::transaction(function() use ($elID, $cantidad, $comentario, $emision) {
				
				$emision->emitido       = $cantidad;
				$emision->observaciones = $comentario;
				$emision->estado        = 'Aprobada';
				$res =	$emision->save();
				if (!$res) return false;

				$info = Emisionpendiente::getSolicitudPendiente($elID);

				$letras = Components::numeroALetras($cantidad,null, 2);
					
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
				//retorna un areglo
				return array('emision'=>$emision, 'certificado'=>$certificado);
			});

			//====
			//trae datos admin
			$admins = Usuario::listAdminEmails();

			//asigna valores a variables 
			if($result) {
				$usuario  = Authusuario::find($result['emision']->usuarioid);
				$email    = $usuario->email;
				$emision  = Emisionpendiente::find($elID);
				$empresas = Usuario::listEmpresaEmails($usuario->empresaid, $usuario->usuarioid);
				$producto = $result['emision']->producto;

				Session::flash('type','success');
				Session::flash('message','La solicitud de emisión fue procesada correctamente');

				//manda email
				try {
					Mail::send('emails/solicitudemisionresultado', array(
						'nombre'        => $usuario->nombre,
						'fecha'         => $result['emision']->created_at,
						'url'           => url('c/'.Crypt::encrypt($result['certificado']->certificadoid)),
						'estado'        => 'Aprobada',
						'contingente'   => $producto,
						'solicitado'    => $emision->solicitado,
						'emitido'       => $cantidad,
						'despedida'     => 'Puede ingresar al enlace <a href="' . url() . '">' . url() . '</a> para ver el estatus de su cuenta corriente.',
						'observaciones' => Input::get('txObservaciones')), function($msg) use ($email, $admins, $empresas){
			       	$msg->to($email)->subject('Certificado DACE - MINECO');
			       	$msg->cc($empresas);
			       	$msg->bcc($admins);
					});
				} catch (Exception $e) {}
			}
			//muestra mensaje
			else {
				Session::flash('type','warning');
				Session::flash('message','Ocurrió un error al intentar autorizar, intente de nuevo.');
			}
		}

		else {
			//asigna valores a las variables
			$emision                = Emisionpendiente::find($elID);
			$emision->observaciones = Input::get('txObservaciones');
			$emision->estado        = 'Rechazada';
			$result                 = $emision->save();

			//valida result
			if($result) {
				Session::flash('type','success');
				Session::flash('message','La solicitud de inscripción fue rechazada');

				$usuario  = Authusuario::find($emision->usuarioid);
				$email    = $usuario->email;
				$empresas = Usuario::listEmpresaEmails($usuario->empresaid, $usuario->usuarioid);

				//manda email
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
		
		//retorna a la vista
		return Redirect::route('solicitudespendientes.emision.index');
	}
}