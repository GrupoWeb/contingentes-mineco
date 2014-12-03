<?php
class emisionController extends BaseController {
	
	function index() {
		return View::make('emision.index')
			->with('contingentes', Usuariocontingente::getContingentes());
	}

	function store() {
		$query      = DB::select(DB::raw('SELECT getSaldo('.Input::get('contingentes').','.Auth::id().') AS disponible'));
		$disponible = $query[0]->disponible;
		$solicitado = Input::get('cantidad');

		if($solicitado > $disponible){
			$message = 'No es posible procesar la solicitud ya que el monto disponible no es suficiente';
			$type    = 'danger';
		}

		else {
			DB::transaction(function() use($solicitado) {
				$solicitud             = new Solicitudesemision;
				$solicitud->usuarioid  = Auth::id();
				$solicitud->periodoid  = Periodo::getPeriodo(Input::get('contingentes'));
				$solicitud->solicitado = $solicitado;
				$solicitud->estado     = 'Pendiente';
				$solicitud->save();

				$partidas                     = new Solicitudemisionpartida;
				$partidas->solicitudemisionid = $solicitud->id;
				$partidas->partidaid          = Input::get('partida');
				$partidas->save();

				foreach (Input::file() as $key=>$val) { 
		      if ($key=='txArchivo') continue;
		    	if ($val) {
						$arch   = Input::file($key);
						$nombre = date('YmdHis').$arch->getClientOriginalName();
						$res    = $arch->move(public_path() . '/archivos/' . Auth::id(), $nombre);
						DB::table('solicitudemisionrequerimientos')->insert(array(
							'solicitudemisionid' => $solicitud->id,
							'requerimientoid'    => substr($key,4),
							'archivo'            => $nombre,
							'created_at'         => date_create(),
							'updated_at'         => date_create()
						));
					}
		    }
		  });
			
			$message = 'Solicitud ingresada exitosamente';
			$type    = 'success';
		}

		Session::flash('message', $message);
		Session::flash('type', $type);

		return Redirect::to('/');
	}
}