<?php
class contingenterequerimientosController extends BaseController {

	public function index($id) {
		//declaracion de variables
		$aAsignacion  = array();
		$aEmision     = array();
		$aInscripcion = array();

		//consulta db segun id
		$ContingenteN = DB::table('contingentes')->where('contingenteid', Crypt::decrypt($id))->first();

		//obtener requirimientos
		$requerimientos    = Requerimiento::getRequerimientos();
		//consulta db segun id
		$id                = Crypt::decrypt($id);
		$nombreContingente = Contingenterequerimiento::getNombre($id);

		//consulta db segun id
		$requerimientosAsignacion  = Contingenterequerimiento::getRequerimientosAsignados($id);
		$requerimientosEmision     = Contingenterequerimiento::getRequerimientosEmision($id);
		$requerimientosInscripcion = Contingenterequerimiento::getRequerimientosInscripcion($id);

		//mete en areglo datos consultados
		foreach ($requerimientosAsignacion as $requAsignados)
			$aAsignacion[] = $requAsignados->requerimientoid;

		foreach ($requerimientosEmision as $requEmision)
			$aEmision[]=$requEmision->requerimientoid;

		foreach ($requerimientosInscripcion as $requInscripcion)
			$aInscripcion[]=$requInscripcion->requerimientoid;

		//asigna valor del formulario
		$tratadoid = Input::get('tratado');

		//retorna datos a la vista
		return View::make('contingentes.asignarrequerimientos')
			->with('ContingenteN',$ContingenteN)
			->with('requerimientos', $requerimientos)
			->with('aAsignacion', $aAsignacion)
			->with('aEmision', $aEmision)
			->with('aInscripcion', $aInscripcion)
			->with('nombreContingente',$nombreContingente)
			->with('tratadoid', $tratadoid)
			->with('tratado', Tratado::getNombre(Crypt::decrypt($tratadoid)))
			->with('mostrarAsignacion', Tipotratado::getAsignacion($ContingenteN->tipotratadoid));
			
	}


	public function store() {
		//obtiene id 
		$contingenteid = Crypt::decrypt(Input::get('contingenteid'));
			DB::table('contingenterequerimientos')->where('contingenteid', $contingenteid)->delete();

		//asignacion de variables con datos del formulario	
		$aAsignacion  = Input::get('reqAsignacion');
		$aEmision     = Input::get('reqEmision');
		$aInscripcion = Input::get('reqInscripcion');

		//elimina elemento si $aAsignacion es null
		if($aAsignacion==null) {
			DB::table('contingenterequerimientos')
				->where('contingenteid', '=', $contingenteid)
				->where('tipo', '=', 'asignacion')
				->delete();
		}

		//inserta datos a la tabla
		else {
			 foreach ($aAsignacion as $contingenteid) {
					$datos = (explode('-', $contingenteid));
					DB::table('contingenterequerimientos')->insert(array('contingenteid'=>$datos[0], 
						'requerimientoid'=>$datos[1], 
						'tipo'           =>'asignacion'));
			}
		}
		
		//elimina elemnto si $aEmision es null
		if($aEmision==null) {
			DB::table('contingenterequerimientos')
				->where('contingenteid', $contingenteid)
				->where('tipo', '=', 'emision')
				->delete();
		}

		//inserta datos a la tabla
		else{
			foreach ($aEmision as $contingenteid) {
				$datos = (explode('-', $contingenteid));
				DB::table('contingenterequerimientos')->insert(
	    			array('contingenteid' => $datos[0], 'requerimientoid' => $datos[1], 'tipo'=>'emision')
				);
			}
		}

		//elimina elemnto si $aInscripcionn es null
		if($aInscripcion==null) {
			DB::table('contingenterequerimientos')
				->where('contingenteid', '=', $contingenteid)
				->where('tipo', '=', 'inscripcion')
				->delete();
		}

		//inserta datos a la tabla
		else{
			foreach ($aInscripcion as $contingenteid) {
				$datos = (explode('-', $contingenteid));
				DB::table('contingenterequerimientos')->insert(
	    			array('contingenteid' => $datos[0], 'requerimientoid' => $datos[1], 'tipo'=>'inscripcion')
				);
			}
		}
		
		//despliega mensaje
		Session::flash('message', 'Se asignaron los requerimientos con éxito.');
		Session::flash('type', 'success');

		//retorna la vista
		return Redirect::to('contingentes?tratado='.Input::get('tratado'));
	}
}