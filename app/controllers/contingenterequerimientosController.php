<?php
class contingenterequerimientosController extends BaseController {

	public function index($id) {
		$aAsignacion = array();
		$aEmision = array();
		$aInscripcion =array();

		$productoN = DB::table('productos')->where('productoid', Crypt::decrypt($id))->first();
		
		$requerimientos = Requerimiento::getRequerimientos();
		
		$id=Crypt::decrypt($id);
		$requerimientosAsignacion 	= productorequerimiento::getRequerimientosAsignados($id);
		$requerimientosEmision 			= productorequerimiento::getRequerimientosEmision($id);
		$requerimientosInscripcion 	= productorequerimiento::getRequerimientosInscripcion($id);

		foreach ($requerimientosAsignacion as $requAsignados) {
			$aAsignacion[]=$requAsignados->requerimientoid;
		}

		foreach ($requerimientosEmision as $requEmision) {
			$aEmision[]=$requEmision->requerimientoid;
		}

		foreach ($requerimientosInscripcion as $requInscripcion) {
			$aInscripcion[]=$requInscripcion->requerimientoid;
		}

		return View::make('contingentes.asignarrequerimientos')
			->with('productoN',$productoN)
			->with('requerimientos', $requerimientos)
			->with('aAsignacion', $aAsignacion)
			->with('aEmision', $aEmision)
			->with('aInscripcion', $aInscripcion);
	}


	public function store() {
		$productoid = Crypt::decrypt(Input::get('productoid'));
			DB::table('productorequerimientos')->where('productoid', '=', $productoid)->delete();
			$aAsignacion = Input::get('reqAsignacion');
			$aEmision    = Input::get('reqEmision');
			$aInscripcion= Input::get('reqInscripcion');

			if($aAsignacion==null){
				DB::table('productorequerimientos')
					->where('productoid', '=', $productoid)
					->where('tipo', '=', 'Asignación')
					->delete();
			}else{
				foreach ($aAsignacion as $producto) {
					$datos = (explode('-', $producto));
					DB::table('productorequerimientos')->insert(
	    				array('productoid' => $datos[0], 'requerimientoid' => $datos[1], 'tipo'=>'Asignación')
					);
				}
			}
			
			if($aEmision==null){
				DB::table('productorequerimientos')
					->where('productoid', '=', $productoid)
					->where('tipo', '=', 'Emisión')
					->delete();
			}else{
				foreach ($aEmision as $producto) {
					$datos = (explode('-', $producto));
					DB::table('productorequerimientos')->insert(
		    			array('productoid' => $datos[0], 'requerimientoid' => $datos[1], 'tipo'=>'Emisión')
					);
				}
			}

			if($aInscripcion==null){
				DB::table('productorequerimientos')
					->where('productoid', '=', $productoid)
					->where('tipo', '=', 'Inscripción')
					->delete();
			}else{
				foreach ($aInscripcion as $producto) {
					$datos = (explode('-', $producto));
					DB::table('productorequerimientos')->insert(
		    			array('productoid' => $datos[0], 'requerimientoid' => $datos[1], 'tipo'=>'Inscripción')
					);
				}
			}
			
			Session::flash('message', 'Se asignaron los requerimientos con éxito.');
			Session::flash('type', 'success');
			return Redirect::route('contingentes.index');
	}

	
}