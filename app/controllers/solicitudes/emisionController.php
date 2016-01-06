<?php
class emisionController extends BaseController {
	
	function index() {
		//retorna valores a la vista
		$contingentes = Empresacontingente::getContingentes();
		
		if(count($contingentes) <= 0) {
			Session::flash('message', 'No se tienen contingente inscritos por lo que es imposible realizar solicitudes de emisión');
			Session::flash('type', 'danger');
			return Redirect::to('inicio');
		}

		return View::make('emision.index')
			->with('contingentes', $contingentes);
	}

	function store() {
		//asigna valores del formulario
		$contingenteid  = Input::get('cmbContingentes');

		try {
			$contingente    = Crypt::decrypt($contingenteid);
		} catch (Exception $e) {
			return View::make('cancerbero::error')
        ->with('mensaje','Contingente inválido.');
		}
		
		//consulta en db segun parametros
		$requerimientos = Contingenterequerimiento::getRequerimientos($contingenteid, 'emision');
		//asigna valor del formulario
		$solicitado     = Input::get('cantidad', 0);

		//considiciona valores
		if(count(Input::file()) <= 0 && count($requerimientos) > 0) {
			//muestra mensaje
			Session::flash('message', 'No se ha cumplido con los requerimientos de archivos necesarios');
			Session::flash('type', 'danger');

			//retorna a la vista
			return Redirect::to('inicio');
		}

		//verifica valor del formulario
		if($solicitado <= 0) {
			//muestra mensaje
			Session::flash('message', 'El monto solicitado no es correcto');
			Session::flash('type', 'danger');

			//retorna la vista
			return Redirect::to('inicio');
		}
		
		//asigna valores de db
		$query       = DB::select(DB::raw('SELECT getSaldo('.$contingente.','.Auth::user()->empresaid .') AS disponible'));
		$disponible  = $query[0]->disponible;

		//condiciona solicitud
		if($solicitado > $disponible){
			$message = 'No es posible procesar la solicitud ya que el monto disponible no es suficiente';
			$type    = 'danger';
		}

		else {
			//inserta valores en db
			$res = DB::transaction(function() use($solicitado, $contingente) {
			$periodo = Periodo::getPeriodo($contingente);

				if(!$periodo) {
					return false;
				}

				else {
					$solicitud             = new Solicitudesemision;
					$solicitud->usuarioid  = Auth::id();
					$solicitud->periodoid  = $periodo; 
					$solicitud->solicitado = $solicitado;
					$solicitud->estado     = 'Pendiente';

					if(Input::has('cmbPais'))
						$solicitud->paisid = Crypt::decrypt(Input::get('cmbPais'));

					$solicitud->save();

					$partidas                     = new Solicitudemisionpartida;
					$partidas->solicitudemisionid = $solicitud->solicitudesemisionid;
					$partidas->partidaid          = Input::get('partida');
					$partidas->save();

					foreach (Input::file() as $key=>$val) { 
			      if ($key=='txArchivo') continue;
			    	if ($val) {
							$arch   = Input::file($key);
							$nombre = date('Ymdhis') . mt_rand(1, 1000) . '.' . strtolower($arch->getClientOriginalExtension());
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
			
			//condiciona mensaje al insertar
			if(!$res){
				$message = 'Error al procesar solicitud';
				$type    = 'danger';
			}

			else {
				$message     = 'Solicitud ingresada exitosamente';
				$type        = 'success';
				$admins      = Usuario::listAdminEmails();
				$email       = Auth::user()->email;
				$empresas    = Usuario::listEmpresaEmails(Auth::user()->empresaid, Auth::id());
				$contindatos = Contingente::getNombre($contingente);

				if($contindatos) {
					$despedida = 'Para mayor información puede escribir a: 
								<a href="mailto:' . $contindatos->responsableemail . '">' . $contindatos->responsable . 
								' &lt;' . $contindatos->responsableemail . '&gt;</a> o ingresando a la página web 
								<a href="' . url() .'">' . url() . '</a>';
				}
				else {
					$despedida = null;
				}

				try {
					//manda correo
					Mail::send('emails/solicitudemision', array(
						'nombre'      => Auth::user()->nombre,
						'contingente' => $contindatos->nombre,
						'despedida'   => $despedida,
						'fecha'       => date('d-m-Y H:i')
			      ), function($msg) use ($email, $admins, $empresas){
			            $msg->to($email)->subject('Solicitud de emisión');
			            $msg->cc($empresas);
			            $msg->bcc($admins);
			    });
				} catch (Exception $e) {}
		  }
		}

		//muestra mensaje
		Session::flash('message', $message);
		Session::flash('type', $type);

		//retorna a la vista
		return Redirect::to('inicio');
	}

	public function getPaises($aContingenteId) {
		//consulta en db segun parametros
		$contingentepais = Contingente::getPais(Crypt::decrypt($aContingenteId));
		
		//retorna datos a la vista
		return View::make('emision.paises')
			->with('contingentepais', $contingentepais)
			->with('paises', Pais::getPaises());
	}
}