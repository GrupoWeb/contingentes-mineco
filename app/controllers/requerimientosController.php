<?php
class requerimientosController extends crudController {

	public function __construct() {
		Crud::setExport(true);
		Crud::setTitulo('Requerimientos');
		Crud::setTabla('requerimientos');
		Crud::setTablaId('requerimientoid');

		Crud::setCampo(array('nombre'=>'Nombre','campo'=>'nombre','reglas' => array('notEmpty'), 'reglasmensaje'=>'El nombre es requerido', 'tipo'=>'string'));
				
		Crud::setPermisos(Cancerbero::tienePermisosCrud('requerimientos'));
	}

	public function getContingentes($id, $tipo) {
      
        $usuarioRq = array();
        if(Auth::id())
        {
          $req = DB::table("usuariorequerimientos")->select("requerimientoid")->where("usuarioid",Auth::id())->get();
          foreach($req as $k=>$v)
            array_push($usuarioRq,$v->requerimientoid);
        }
      
		return Response::json(Contingenterequerimiento::getRequerimientos($id, $tipo,$usuarioRq));
	}

	public function getVacio() {
		return View::make('requerimientos/vacio');
	}
}
