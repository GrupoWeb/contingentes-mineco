<?php
class solicitudesasignacionController extends crudController {

	public function __construct() {
		Crud::setExport(false);
		Crud::setSearch(false);
		Crud::setTitulo('Solicitudes pendientes - Asignación');
		Crud::setTabla('solicitudasignacion');
		Crud::setTablaId('solicitudasignacionid');
		
		Crud::setLeftJoin('authusuarios AS u', 'solicitudasignacion.usuarioid', '=', 'u.usuarioid');
		Crud::setLeftJoin('empresas AS e', 'u.empresaid', '=', 'e.empresaid');
		Crud::setLeftJoin('periodos AS p', 'solicitudasignacion.periodoid', '=', 'p.periodoid');
		Crud::setLeftJoin('contingentes AS c', 'p.contingenteid', '=', 'c.contingenteid');
		Crud::setLeftJoin('tratados AS t', 'c.tratadoid', '=', 't.tratadoid');
		Crud::setLeftJoin('productos AS d', 'c.productoid', '=', 'd.productoid');

		Crud::setWhere('estado', 'Pendiente');

		$tselected = Session::get('tselected');
		if($tselected <> 0) {
			Crud::setWhere('c.tratadoid', $tselected);
			Crud::setTitulo('Solicitudes pendientes - Asignación - '.Tratado::getNombre($tselected));
		}

		Crud::setCampo(array('nombre'=>'Usuario','campo'=>'u.nombre'));
		Crud::setCampo(array('nombre'=>'Empresa','campo'=>'e.razonsocial'));
		Crud::setCampo(array('nombre'=>'Tratado','campo'=>'t.nombrecorto'));
		Crud::setCampo(array('nombre'=>'Producto','campo'=>'d.nombre','class'=>'text-right'));
		Crud::setCampo(array('nombre'=>'Monto Solicitado','campo'=>'solicitado','tipo'=>'numeric','class'=>'text-right','decimales'=>3));
		Crud::setCampo(array('nombre'=>'Fecha de solicitud','campo'=>'solicitudasignacion.created_at', 'tipo'=>'datetime','class'=>'text-right'));
		
		Crud::setPermisos(Cancerbero::tienePermisosCrud('solicitudespendientes.emision'));
	}

	public function edit($id) {
		$solicitud 			= Asignacionpendiente::getSolicitudPendiente(Crypt::decrypt($id));
		$requerimientos = Asignacionrequerimiento::getRequerimientos(Crypt::decrypt($id));

		return View::make('solicitudespendientes/asignaciones')
			->with('solicitud',$solicitud)
			->with('requerimientos',$requerimientos);
	}

	public function store() {
		$elID = Crypt::decrypt(Input::get('id'));
		
		if(Input::has('btnAutorizar')) {
			$cantidad   = Input::get('txCantidad');

			if ($cantidad<=0) {
				Session::flash('type','warning');
				Session::flash('message','La cantidad debe ser mayor a cero.');
				return Redirect::route('solicitudespendientes.asignacion.index');
			}

			$comentario = Input::get('txObservaciones');
			
			//TRANSACTION ===
			$asignacion = DB::transaction(function() use($elID, $cantidad, $comentario) {
				$asignacion                = Asignacionpendiente::find($elID);
				$asignacion->asignado      = $cantidad;
				$asignacion->observaciones = $comentario;
				$asignacion->estado        = 'Aprobada';
				$result                    = $asignacion->save();

				$movimiento                   = new Movimiento;
				$movimiento->periodoid        = $asignacion->periodoid;
				$movimiento->usuarioid        = $asignacion->usuarioid;
				$movimiento->cantidad         = $cantidad;
				$movimiento->comentario       = $comentario;
				$movimiento->created_by       = Auth::id();
				$movimiento->tipomovimientoid = DB::table('tiposmovimiento')->where('nombre', 'Asignación')->pluck('tipomovimientoid');
				$movimiento->acta             = Input::get('txActa');
				$result2                      = $movimiento->save();

				return $asignacion;
			});
			//====
			$admins = Usuario::listAdminEmails();

			if($asignacion) {
				$usuario  = Authusuario::find($asignacion->usuarioid);
				$email    = $usuario->email;
				$empresas = Usuario::listEmpresaEmails($usuario->empresaid, $usuario->usuarioid);

				Session::flash('type','success');
				Session::flash('message','La solicitud de asignación fue procesada correctamente');

				try {
					Mail::send('emails/solicitudasignacionresultado', array(
						'nombre'        => $usuario->nombre,
						'fecha'         => $asignacion->created_at,
						'estado'        => 'Aprobada',
						'contingente'   => $asignacion->producto,
						'solicitado'    => $asignacion->solicitado,
						'asignado'      => $cantidad,
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
			$asignacion                = Asignacionpendiente::find($elID);
			$asignacion->observaciones = Input::get('txObservaciones');
			$asignacion->estado        = 'Rechazada';
			$result                    = $asignacion->save();

			if($result) {
				Session::flash('type','success');
				Session::flash('message','La solicitud de inscripción fue rechazada');

				$usuario  = Authusuario::find($asignacion->usuarioid);
				$email    = $usuario->email;
				$empresas = Usuario::listEmpresaEmails($usuario->empresaid, $usuario->usuarioid);

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

		return Redirect::route('solicitudespendientes.asignacion.index');
	}
}
