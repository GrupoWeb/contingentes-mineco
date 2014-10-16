<?php
class periodosController extends BaseController {

	private $crud, $cancerbero;

	public function __construct() {
		$this->cancerbero = new Cancerbero;
		$this->crud       = new Crud;

		$this->crud->setExport(false);
		$this->crud->setTitulo('Periodos');
		$this->crud->setTabla('periodos');
		$this->crud->setTablaId('periodoid');

		$this->crud->setLeftJoin('productos AS p', 'periodos.productoid', '=', 'p.productoid');

		$this->crud->setCampo(array('nombre'=>'Producto','campo'=>'p.nombre','tipo'=>'combobox',
				'query'=>'SELECT nombre,productoid FROM productos ORDER BY nombre','combokey'=>'productoid'));

		$this->crud->setCampo(array('nombre'=>'Nombre','campo'=>'periodos.nombre','tipo'=>'string','reglas' => array('notEmpty'), 'reglasmensaje'=>'El nombre es requerido' ));
		$this->crud->setCampo(array('nombre'=>'Fechainicio','campo'=>'periodos.fechainicio','tipo'=>'date'));
		$this->crud->setCampo(array('nombre'=>'Fechafin','campo'=>'periodos.fechafin','tipo'=>'date'));

		$this->crud->setCampo(array('nombre'=>'Tipo','campo'=>'periodos.tipo','tipo'=>'enum','enumarray'=>array('Exportación'=>'Exportación','Importación'=>'Importación')));
		
		$this->crud->setPermisos($this->cancerbero->tienePermisosCrud('usuarios'));
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