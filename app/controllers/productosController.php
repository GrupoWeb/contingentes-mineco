<?php
class productosController extends BaseController {

	private $crud, $cancerbero;

	public function __construct() {
		$this->cancerbero = new Cancerbero;
		$this->crud       = new Crud;

		$this->crud->setExport(true);
		$this->crud->setTitulo('Productos');
		$this->crud->setTabla('productos');
		$this->crud->setTablaId('productoid');

		$this->crud->setCampo(array('nombre'=>'Nombre','campo'=>'nombre','reglas' => array('notEmpty'), 'reglasmensaje'=>'El nombre es requerido', 'tipo'=>'string'));
		$this->crud->setCampo(array('nombre'=>'Activo','campo'=>'activo','tipo'=>'bool'));
		
		$this->crud->setBotonExtra(array('url'=>'productorequerimiento', 'titulo'=>'Requerimientos de Producto', 'icon'=>'glyphicon glyphicon-ok', 'class'=>'warning'));
		$this->crud->setPermisos($this->cancerbero->tienePermisosCrud('catalogos.productos'));
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
}
