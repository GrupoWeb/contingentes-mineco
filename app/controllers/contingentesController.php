<?php
class contingentesController extends BaseController {

	private $crud, $cancerbero;

	public function __construct() {
		$this->cancerbero = new Cancerbero;
		$this->crud       = new Crud;

		$this->crud->setExport(true);
		$this->crud->setTitulo('Contingentes');
		$this->crud->setTabla('productos');
		$this->crud->setTablaId('productoid');

		$this->crud->setCampo(array('nombre'=>'Nombre','campo'=>'nombre','reglas' => array('notEmpty'), 'reglasmensaje'=>'El nombre es requerido', 'tipo'=>'string'));
		$this->crud->setCampo(array('nombre'=>'Activo','campo'=>'activo','tipo'=>'bool'));
		
		$this->crud->setBotonExtra(array('url'=>'contingente/requerimientos/', 'titulo'=>'Requerimientos Contingente', 'icon'=>'glyphicon glyphicon-ok', 'class'=>'warning'));
		$this->crud->setPermisos($this->cancerbero->tienePermisosCrud('contingentes'));
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

	public function getSaldo($contingenteid) {
		$disponible             = DB::select(DB::raw('SELECT getSaldo('.$contingenteid.','.Auth::id().') AS disponible'));
		$response['disponible'] = $disponible[0]->disponible;
		$response['unidad']     = Contingente::getUnidadMedida($contingenteid);

		return Response::json($response);
	}
}
