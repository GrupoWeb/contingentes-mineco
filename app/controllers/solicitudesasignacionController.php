<?php
class solicitudesasignacionController extends BaseController {

	public function index() {
		
	}

	/*private $crud, $cancerbero;

	public function __construct() {
		$this->cancerbero = new Cancerbero;
		$this->crud       = new Crud;

		$this->crud->setExport(true);
		$this->crud->setTitulo('Solicitudes Pendientes');
		$this->crud->setTabla('authusuarios');
		$this->crud->setTablaId('usuarioid');
		$this->crud->setWhere('authusuarios.activo',0);

		$this->crud->setCampo(array('nombre'=>'Nombre','campo'=>'nombre','reglas' => array('notEmpty'), 'reglasmensaje'=>'El nombre es requerido', 'tipo'=>'string'));
		$this->crud->setCampo(array('nombre'=>'Email','campo'=>'email','reglas' => array('notEmpty'), 'reglasmensaje'=>'El nombre es requerido', 'tipo'=>'string'));
		$this->crud->setCampo(array('nombre'=>'Fecha de solicitud','campo'=>'created_at','reglas' => array('notEmpty'), 'reglasmensaje'=>'El nombre es requerido', 'tipo'=>'string'));
		$this->crud->setCampo(array('nombre'=>'Activo','campo'=>'activo','tipo'=>'bool'));

		$this->crud->setBotonExtra(array('url'=>'solicitudespendientes/datossolicitud','icon'=>'glyphicon glyphicon-list-alt','titulo'=>'Ver detalle'));
		
		$this->crud->setPermisos($this->cancerbero->tienePermisosCrud('solicitudespendientes.asignacion'));
	}

	public function index() {
		return $this->crud->index();
	}

	public function create() {
		return $this->crud->create(0);
	}

	public function store() {
		return $this->crud->store();
	}

	public function show($id) {
		return $this->crud->getData($id);
	}

	public function edit($id) {
		return $this->crud->create($id);
	}

	public function update($id) {
		return $this->crud->store($id);
	}

	public function destroy($id) {
		return $this->crud->destroy($id);
	}

	public function inscripcionesPendientes() {
		return View::make('solicitudespendientes/inscripciones')
			->with('solicitudes', $solicitudesInscripcion);
	}

	public function datosSolicitud($id){
		$solicitud      = Inscripcionependiente::getSolicitudPendiente(Crypt::decrypt($id));
		$requerimientos = Usuariorequerimiento::getUsuarioRequerimientos(Crypt::decrypt($id));

		return View::make('solicitudespendientes/create')->with('solicitud',$solicitud)->with('requerimientos',$requerimientos);
	}

	public function autorizar($id){
		if(Input::get('act')==1) {
			$usuario         = Inscripcionependiente::find(Crypt::decrypt($id));
			$usuario->activo = 1;
			$result          = $usuario->save();

			$email   = $usuario->email;

			if($result) {
				Session::flash('type','success');
				Session::flash('message','Se autorizó el usuario con éxito');

				Mail::send('emails/autorizacion', array(
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
		else{
			$affectedRows  = Usuariocontingente::where('usuarioid', '=', Crypt::decrypt($id))->delete();
			$affectedRows2 = Usuariorequerimiento::where('usuarioid', '=', Crypt::decrypt($id))->delete();
			$usuario       = Inscripcionependiente::find(Crypt::decrypt($id));
			$nombre        = $usuario->nombre;
			$email         = $usuario->email;
			$result        = $usuario->delete();
			if($result) {
				Session::flash('type','success');
				Session::flash('message','Se rechazó la solicitud con éxito');

				Mail::send('emails/autorizacion', array(
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

		return Redirect::to('catalogos/solicitudespendientes');
	}*/
}
