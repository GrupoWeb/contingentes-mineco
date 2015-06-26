<?php
class emisionController extends BaseController {
	
	function index() {
		return View::make('emision.index')
			->with('contingentes', Empresacontingente::getContingentes());
	}

	function store() {
		$contingenteid  = Input::get('cmbContingentes');
		$contingente    = Crypt::decrypt($contingenteid);
		$requerimientos = Contingenterequerimiento::getRequerimientos($contingenteid, 'emision');
		$producto       = Contingente::getNombre($contingente);
		$solicitado     = Input::get('cantidad', 0);

		if(count(Input::file()) <= 0 && count($requerimientos) > 0) {
			Session::flash('message', 'No se ha cumplido con los requerimientos de archivos necesarios');
			Session::flash('type', 'danger');

			return Redirect::to('/');
		}

		if($solicitado <= 0) {
			Session::flash('message', 'El monto solicitado no es correcto');
			Session::flash('type', 'danger');

			return Redirect::to('/');
		}

		
		$query       = DB::select(DB::raw('SELECT getSaldo('.$contingente.','.Auth::id().') AS disponible'));
		$disponible  = $query[0]->disponible;
		

		if($solicitado > $disponible){
			$message = 'No es posible procesar la solicitud ya que el monto disponible no es suficiente';
			$type    = 'danger';
		}

		else {
			$res = DB::transaction(function() use($solicitado, $contingente) {
				$periodo = Periodo::getPeriodo($contingente);

				if(!$periodo) {
					return false;
				}

				else {
					$solicitud             = new Solicitudesemision;
					$solicitud->usuarioid  = Auth::id();
					$solicitud->periodoid  = $periodo; //Periodo::getPeriodo($contingente);
					$solicitud->solicitado = $solicitado;
					$solicitud->estado     = 'Pendiente';
					$solicitud->paisid     = Crypt::decrypt(Input::get('cmbPais'));
					$solicitud->save();

					$partidas                     = new Solicitudemisionpartida;
					$partidas->solicitudemisionid = $solicitud->solicitudesemisionid;
					$partidas->partidaid          = Input::get('partida');
					$partidas->save();

					foreach (Input::file() as $key=>$val) { 
			      if ($key=='txArchivo') continue;
			    	if ($val) {
							$arch   = Input::file($key);
							$nombre = date('YmdHis').$arch->getClientOriginalName();
							$res    = $arch->move(public_path() . '/archivos/' . Auth::id(), $nombre);
							
							DB::table('solicitudemisionrequerimientos')->insert(array(
								'solicitudemisionid' => $solicitud->solicitudesemisionid,
								'requerimientoid'    => substr($key,4),
								'archivo'            => $nombre,
								'created_at'         => date_create(),
								'updated_at'         => date_create()
							));
						}
			    }

			    return true;
			  }
		  });
			
			if(!$res){
				$message = 'Error al procesar solicitud';
				$type    = 'danger';
			}

			else {
				$message  = 'Solicitud ingresada exitosamente';
				$type     = 'success';
				$admins   = Usuario::listAdminEmails();
				$email    = Auth::user()->email;
				$empresas = Usuario::listEmpresaEmails(Auth::user()->empresaid, Auth::id());

				try {
					Mail::send('emails/solicitudemision', array(
			      'nombre' => Auth::user()->nombre,
			      'contingente' => $producto,
			      'fecha'  => date('d-m-Y H:i')
			      ), function($msg) use ($email, $admins, $empresas){
			            $msg->to($email)->subject('Solicitud de emisión');
			            $msg->cc($empresas);
			            $msg->bcc($admins);
			    });
				} catch (Exception $e) {}
		  }
		}

		Session::flash('message', $message);
		Session::flash('type', $type);

		return Redirect::to('/');
	}

	public function getPaises($aContingenteId) {
		$contingentepais = Contingente::getPais(Crypt::decrypt($aContingenteId));
		
		return View::make('emision.paises')
			->with('contingentepais', $contingentepais)
			->with('paises', Pais::getPaises());
	}
}