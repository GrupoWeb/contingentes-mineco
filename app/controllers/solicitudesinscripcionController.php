<?php
class solicitudesinscripcionController extends crudController {

	public function __construct() {
		Crud::setExport(false);
		Crud::setSearch(false);
		Crud::setTitulo('Solicitudes pendientes - Inscripción');
		Crud::setTabla('authusuarios');
		Crud::setTablaId('usuarioid');
		Crud::setWhere('authusuarios.activo',0);

		Crud::setCampo(array('nombre'=>'Nombre','campo'=>'nombre'));
		Crud::setCampo(array('nombre'=>'Email','campo'=>'email'));
		Crud::setCampo(array('nombre'=>'Fecha de solicitud','campo'=>'created_at', 'tipo'=>'datetime'));
		Crud::setCampo(array('nombre'=>'Activo','campo'=>'activo','tipo'=>'bool'));
		Crud::setPermisos(Cancerbero::tienePermisosCrud('solicitudespendientes.inscripcion'));
	}

	public function edit($id){
		$solicitud 			= Solicitudpendiente::getSolicitudPendiente(Crypt::decrypt($id));
		$requerimientos = Usuariorequerimiento::getUsuarioRequerimientos(Crypt::decrypt($id));

		return View::make('solicitudespendientes/inscripciones')
			->with('solicitud',$solicitud)
			->with('requerimientos',$requerimientos);
	}

	public function store(){
		//dd(Input::all());
		$elID = Crypt::decrypt(Input::get('id'));

		if(Input::has('btnAutorizar')) {
			$usuario         = Solicitudpendiente::find($elID);
			$usuario->activo = 1;
			$result          = $usuario->save();

			if($result) {
				$email = $usuario->email;

				Session::flash('type','success');
				Session::flash('message','La solicitud de inscripción fue procesada correctamente');

				Mail::send('emails/solicitudinscripcionresultado', array(
					'nombre'        => $usuario->nombre,
					'fecha'         => $usuario->created_at,
					'estado'        => 'Aprobada',
					'observaciones' => Input::get('txObservaciones')), function($msg) use ($email){
		       	$msg->to($email)->subject('Solicitud de Inscripción DACE - MINECO');
				});
			}
			else {
				Session::flash('type','warning');
				Session::flash('message','Ocurrió un error al intentar autorizar, intente de nuevo.');
			}
		}
		else {
			$affectedRows  = Usuarioproducto::where('usuarioid', $elID)->delete();
			$affectedRows2 = Usuariorequerimiento::where('usuarioid',$elID)->delete();
			//Se borra el usuario
			$usuario = Solicitudpendiente::find($elID);
			$nombre  = $usuario->nombre;
			$email   = $usuario->email;
			$result  = $usuario->delete();
			if($result) {
				Session::flash('type','success');
				Session::flash('message','La solicitud de inscripción fue rechazada');

				Mail::send('emails/solicitudinscripcionresultado', array(
					'nombre'        => $usuario->nombre,
					'fecha'         => $usuario->created_at,
					'estado'        => 'Rechazada',
					'observaciones' => Input::get('txObservaciones')), function($msg) use ($email){
		       	$msg->to($email)->subject('Solicitud de Inscripción DACE - MINECO');
				});
			}
			else {
				Session::flash('type','warning');
				Session::flash('message','Ocurrió un error al intentar rechazar, intente de nuevo.');
			}
		}
		return Redirect::route('solicitudespendientes.inscripcion.index');
	}
}