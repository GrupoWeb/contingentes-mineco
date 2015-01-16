<?php
class contingenterequerimientosController extends BaseController {

	public function index($id) {
		$aAsignacion  = array();
		$aEmision     = array();
		$aInscripcion =array();

		$ContingenteN = DB::table('contingentes')->where('contingenteid', Crypt::decrypt($id))->first();

		$requerimientos    = Requerimiento::getRequerimientos();
		$id                = Crypt::decrypt($id);
		$nombreContingente = Contingenterequerimiento::getNombre($id);

		if($ContingenteN->asignacion <> 0) {
			$requerimientosAsignacion  = Contingenterequerimiento::getRequerimientosAsignados($id);

			foreach ($requerimientosAsignacion as $requAsignados) {
				$aAsignacion[] = $requAsignados->requerimientoid;
			}
		}
		
		$requerimientosEmision     = Contingenterequerimiento::getRequerimientosEmision($id);
		$requerimientosInscripcion = Contingenterequerimiento::getRequerimientosInscripcion($id);


		foreach ($requerimientosEmision as $requEmision) {
			$aEmision[]=$requEmision->requerimientoid;
		}

		foreach ($requerimientosInscripcion as $requInscripcion) {
			$aInscripcion[]=$requInscripcion->requerimientoid;
		}

		$tratadoid = Input::get('tratado');

		return View::make('contingentes.asignarrequerimientos')
			->with('ContingenteN',$ContingenteN)
			->with('requerimientos', $requerimientos)
			->with('aAsignacion', $aAsignacion)
			->with('aEmision', $aEmision)
			->with('aInscripcion', $aInscripcion)
			->with('nombreContingente',$nombreContingente)
			->with('tratadoid', $tratadoid)
			->with('tratado', Tratado::getNombre(Crypt::decrypt($tratadoid)));
			
	}


	public function store() {
		$contingenteid = Crypt::decrypt(Input::get('contingenteid'));
			DB::table('contingenterequerimientos')->where('contingenteid', $contingenteid)->delete();

		$aAsignacion  = Input::get('reqAsignacion');
		$aEmision     = Input::get('reqEmision');
		$aInscripcion = Input::get('reqInscripcion');

		if($aAsignacion==null) {
			DB::table('contingenterequerimientos')
				->where('contingenteid', '=', $contingenteid)
				->where('tipo', '=', 'asignacion')
				->delete();
		}

		else {
			 foreach ($aAsignacion as $contingenteid) {
					$datos = (explode('-', $contingenteid));
					DB::table('contingenterequerimientos')->insert(array('contingenteid'=>$datos[0], 
						'requerimientoid'=>$datos[1], 
						'tipo'           =>'asignacion'));
			}
		}
		
		if($aEmision==null) {
			DB::table('contingenterequerimientos')
				->where('contingenteid', $contingenteid)
				->where('tipo', '=', 'emision')
				->delete();
		}

		else{
			foreach ($aEmision as $contingenteid) {
				$datos = (explode('-', $contingenteid));
				DB::table('contingenterequerimientos')->insert(
	    			array('contingenteid' => $datos[0], 'requerimientoid' => $datos[1], 'tipo'=>'emision')
				);
			}
		}

		if($aInscripcion==null) {
			DB::table('contingenterequerimientos')
				->where('contingenteid', '=', $contingenteid)
				->where('tipo', '=', 'inscripcion')
				->delete();
		}

		else{
			foreach ($aInscripcion as $contingenteid) {
				$datos = (explode('-', $contingenteid));
				DB::table('contingenterequerimientos')->insert(
	    			array('contingenteid' => $datos[0], 'requerimientoid' => $datos[1], 'tipo'=>'inscripcion')
				);
			}
		}
		
		Session::flash('message', 'Se asignaron los requerimientos con éxito.');
		Session::flash('type', 'success');

		return Redirect::to('contingentes?tratado='.Input::get('tratado'));
	}
}