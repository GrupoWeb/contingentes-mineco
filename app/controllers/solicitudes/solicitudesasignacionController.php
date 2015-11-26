<?php
class solicitudesasignacionController extends crudController {

	public function __construct() {
		//funcion exporta .xls
		Crud::setExport(false);
		//funcion buscar
		Crud::setSearch(false);
		//titulo catalogo
		Crud::setTitulo('Solicitudes pendientes - Asignación');

		//conexion db a la tabla
		Crud::setTabla('solicitudasignacion');
		Crud::setTablaId('solicitudasignacionid');

		//relacion entre tablas
		Crud::setLeftJoin('authusuarios AS u', 'solicitudasignacion.usuarioid', '=', 'u.usuarioid');
		Crud::setLeftJoin('empresas AS e', 'u.empresaid', '=', 'e.empresaid');
		Crud::setLeftJoin('periodos AS p', 'solicitudasignacion.periodoid', '=', 'p.periodoid');
		Crud::setLeftJoin('contingentes AS c', 'p.contingenteid', '=', 'c.contingenteid');
		Crud::setLeftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid');
		Crud::setLeftJoin('productos AS d', 'c.productoid', '=', 'd.productoid');

		//condicion db
		Crud::setWhere('estado', 'Pendiente');

		//asigna valor de session y condiciona en db
		$tselected = Session::get('tselected');
		if($tselected <> 0) {
			Crud::setWhere('c.tratadoid', $tselected);
			Crud::setTitulo('Solicitudes pendientes - Asignación - '.Tratado::getNombre($tselected));
		}

		//definicion de campos con datos de la conexion db
		Crud::setCampo(array('nombre'=>'Usuario','campo'=>'u.nombre'));
		Crud::setCampo(array('nombre'=>'Empresa','campo'=>'e.razonsocial'));
		Crud::setCampo(array('nombre'=>'Tratado','campo'=>'t.nombrecorto'));
		Crud::setCampo(array('nombre'=>'Producto','campo'=>'d.nombre','class'=>'text-right'));
		Crud::setCampo(array('nombre'=>'Monto Solicitado','campo'=>'solicitado','tipo'=>'numeric','class'=>'text-right','decimales'=>3));
		Crud::setCampo(array('nombre'=>'Fecha de solicitud','campo'=>'solicitudasignacion.created_at', 'tipo'=>'datetime','class'=>'text-right'));
		
		//permisos cancerbero
		Crud::setPermisos(Cancerbero::tienePermisosCrud('solicitudespendientes.emision'));
	}

	public function edit($id) {
		//captura id del elemento y cunsulta en db
		$id             = Crypt::decrypt($id);
		$solicitud 			= Asignacionpendiente::getSolicitudPendiente($id);
		$requerimientos = Asignacionrequerimiento::getRequerimientos($id);
		$query          = DB::select(DB::raw('SELECT getSaldoAsignacionPeriodo('.$solicitud->periodoid.') AS disponible'));

		//retorna datos a la vista
		return View::make('solicitudespendientes/asignaciones')
			->with('solicitud',$solicitud)
			->with('requerimientos',$requerimientos)
			->with('maximo', $query[0]->disponible);
	}

	public function store() {
		//captura id de hidden
		$elID = Crypt::decrypt(Input::get('id'));
		
		//condiciona dato de formulario
		if(Input::has('btnAutorizar')) {
			$cantidad   = Input::get('txCantidad');

			//condion para mensaje 
			if ($cantidad<=0) {
				Session::flash('type','warning');
				Session::flash('message','La cantidad debe ser mayor a cero.');
				return Redirect::route('solicitudespendientes.asignacion.index');
			}

			//traer objeto segun id
			$asignacion = Asignacionpendiente::find($elID);

			$query       = DB::select(DB::raw('SELECT getSaldoAsignacionPeriodo('.$asignacion->periodoid.') AS disponible'));
			$disponible  = $query[0]->disponible;

			//compara cantidad con disponible 
			if($cantidad > $disponible){
				Session::flash('type','danger');
				Session::flash('message','No es posible procesar la solicitud ya que el monto disponible no es suficiente');
				return Redirect::route('solicitudespendientes.asignacion.index');
			}

			//asigna dato del campo
			$comentario = Input::get('txObservaciones');
			
			//TRANSACTION ===
			//inserta datos en db
			$asignacion = DB::transaction(function() use($elID, $cantidad, $comentario, $asignacion) {
				$acta = Input::get('txActa');

				$asignacion->asignado      = $cantidad;
				$asignacion->observaciones = $comentario;
				$asignacion->estado        = 'Aprobada';
				$asignacion->acta          = $acta;
				$result                    = $asignacion->save();

				$movimiento                   = new Movimiento;
				$movimiento->periodoid        = $asignacion->periodoid;
				$movimiento->usuarioid        = $asignacion->usuarioid;
				$movimiento->cantidad         = $cantidad;
				$movimiento->comentario       = $comentario;
				$movimiento->created_by       = Auth::id();
				$movimiento->tipomovimientoid = DB::table('tiposmovimiento')->where('nombre', 'Asignación')->pluck('tipomovimientoid');
				$movimiento->acta             = $acta;
				$result2                      = $movimiento->save();

				return $asignacion;
			});
			
			//traer datos de admin
			$admins = Usuario::listAdminEmails();

			//condicona asignacion y consulta segun usuario
			if($asignacion) {
				$usuario  = Authusuario::find($asignacion->usuarioid);
				$email    = $usuario->email;
				$empresas = Usuario::listEmpresaEmails($usuario->empresaid, $usuario->usuarioid);

				Session::flash('type','success');
				Session::flash('message','La solicitud de asignación fue procesada correctamente');

				//manda email
				try {
					Mail::send('emails/solicitudasignacionresultado', array(
						'nombre'        => $usuario->nombre,
						'fecha'         => $asignacion->created_at,
						'estado'        => 'Aprobada',
						'contingente'   => $asignacion->producto,
						'solicitado'    => $asignacion->solicitado,
						'asignado'      => $cantidad,
						'despedida'     => 'Puede ingresar al enlace <a href="' . url() . '">' . url() .'</a> para realizar sus solicitudes de certificados.',
						'observaciones' => Input::get('txObservaciones')), function($msg) use ($email, $admins, $empresas){
			       	$msg->to($email)->subject('Solicitud de Asignación DACE - MINECO');
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
			//asigna valores
			$asignacion                = Asignacionpendiente::find($elID);
			$asignacion->observaciones = Input::get('txObservaciones');
			$asignacion->estado        = 'Rechazada';
			$result                    = $asignacion->save();

			//condicion de mensaje
			if($result) {
				Session::flash('type','success');
				Session::flash('message','La solicitud de inscripción fue rechazada');

				$usuario  = Authusuario::find($asignacion->usuarioid);
				$email    = $usuario->email;
				$empresas = Usuario::listEmpresaEmails($usuario->empresaid, $usuario->usuarioid);

				//manda email
				try {
					Mail::send('emails/solicitudasignacionresultado', array(
						'nombre'        => $usuario->nombre,
						'fecha'         => $asignacion->created_at,
						'estado'        => 'Rechazada',
						'contingente'   => $asignacion->producto,
						'solicitado'    => $asignacion->solicitado,
						'asignado'      => 0,
						'observaciones' => Input::get('txObservaciones')), function($msg) use ($email, $admins, $empresas){
			       	$msg->to($email)->subject('Solicitud de Asignación DACE - MINECO');
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

		//retona a la vista
		return Redirect::route('solicitudespendientes.asignacion.index');
	}
}
