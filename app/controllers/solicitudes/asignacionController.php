<?php

class asignacionController extends BaseController {

	public function index() {
		return View::make('asignaciones.index')
			->with('contingentes', Empresacontingente::getContingentes(true));
	}

	public function store() {
		$contingenteid  = Input::get('cmbContingentes');
		$contingente    = Crypt::decrypt($contingenteid);
		$requerimientos = Contingenterequerimiento::getRequerimientos($contingenteid, 'asignacion');
		$solicitado     = Input::get('cantidad', 0);

		if(count(Input::file()) <= 0 && count($requerimientos) > 0) {
			Session::flash('message', 'No se ha cumplido con los requerimientos de archivos necesarios');
			Session::flash('type', 'danger');

			return Redirect::to('inicio');
		}

		/*if($solicitado <= 0) {
			Session::flash('message', 'El monto solicitado no es correcto');
			Session::flash('type', 'danger');

			return Redirect::to('inicio');
		}

		$query       = DB::select(DB::raw('SELECT getSaldoAsignacion('.$contingente.','.Auth::id().') AS disponible'));
		$disponible  = $query[0]->disponible;

		if($solicitado > $disponible){
			$message = 'No es posible procesar la solicitud ya que el monto disponible no es suficiente';
			$type    = 'danger';
		}*/

		//else {
			$res = DB::transaction(function() use($solicitado, $contingente) {

				$periodo = Periodo::getPeriodo($contingente);

				if(!$periodo) {
					return false;
				}

				else { 
					$solicitud             = new Solicitudasignacion;
					$solicitud->usuarioid  = Auth::id();
					$solicitud->periodoid  = $periodo; //Periodo::getPeriodo($contingente);
					$solicitud->estado     = 'Pendiente';
					$solicitud->solicitado = $solicitado;
					$solicitud->save();

					foreach (Input::file() as $key=>$val) { 
			      if ($key=='txArchivo') continue;
			    	if ($val) {
							$arch   = Input::file($key);
							$nombre = date('Ymdhis') . mt_rand(1, 1000) . '.' . strtolower($arch->getClientOriginalExtension());
							$res    = $arch->move(public_path() . '/archivos/' . Auth::id(), $nombre);
							DB::table('solicitudasignacionrequerimientos')->insert(array(
								'solicitudasignacionid' => $solicitud->id,
								'requerimientoid'       => substr($key,4),
								'archivo'               => $nombre,
								'created_at'            => date_create(),
								'updated_at'            => date_create()
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
				$message     = 'Solicitud ingresada exitosamente';
				$type        = 'success';
				$contingente = Contingente::getNombre($contingente);
				$email       = Auth::user()->email;
				$admins      = Usuario::listAdminEmails();
				$empresas    = Usuario::listEmpresaEmails(Auth::user()->empresaid, Auth::id());

				if($contingente) {
					$despedida = 'Para mayor información puede escribir a: 
								<a href="mailto:' . $contingente->responsableemail . '">' . $contingente->responsable . 
								' &lt;' . $contingente->responsableemail . '&gt;</a> o ingresando a la página web 
								<a href="' . url() .'">' . url() . '</a>';
				}
				else {
					$despedida = null;
				}
				
				try {
					Mail::send('emails/solicitudasignacion', array(
						'nombre'      => Auth::user()->nombre,
						'fecha'       => date('d-m-Y H:i'),
						'contingente' => $contingente->nombre,
						'despedida'   => $despedida,
						'monto'       => $solicitado
			      ), function($msg) use ($email, $admins, $empresas){
		            $msg->to($email)->subject('Solicitud de asignación');
		            $msg->cc($empresas);
		            $msg->bcc($admins);
			    });
				} catch (Exception $e) {}
		  }
		//}

		Session::flash('message', $message);
		Session::flash('type', $type);

		return Redirect::to('inicio');
	}
}