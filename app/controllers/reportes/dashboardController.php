<?php

class dashboardController extends BaseController {
	public function index() {
		//camptura datos usuario
		$admin = in_array(Auth::user()->rolid, Config::get('contingentes.roladmin'));

		if($admin){
			//consulta en db 
			$tratados              = Tratado::getTratados();

			$pendientesinscripcion = 0;
			$pendientesasignacion  = 0;
			$pendientesemision     = 0;
			$datos                 = array();

			//se contruye la informacion de cada objeto
			foreach($tratados as $tratado) {
				//consulta en db segun parametros
				$contingentes = Contingente::getContingentesTratado($tratado->tratadoid);
				$empresas     = Tratado::getEmpresasTratado($tratado->tratadoid);
				//dd(DB::getQueryLog());

				$tingentes             = array();
				//contruye informacion del objeto y lo almacena en areglo
				foreach($contingentes as $contingente) {
					//consulta en db tipotratado segun contingente
					$asignacion = Contingente::getTipoTratado($contingente);
					if($asignacion == 0)
						$query = DB::select(DB::raw('SELECT getSaldo('.$contingente.', 0) AS saldo'));
					else
						$query = DB::select(DB::raw('SELECT getSaldoAsignacion('.$contingente.', 0) AS saldo'));
					
					//consulta en db segun contingente
					$inscritos   = Empresacontingente::getEmpresasContingente($contingente);
					//dd(DB::getQueryLog());
					//asigna valores al arreglo
					$tingentes[] = array(
						'contingenteid' => $contingente,
						'nombre'        => Contingente::getProducto($contingente),
						'saldo'         => ($query?$query[0]->saldo:0),
						'inscritos'     => count($inscritos)
					);
				}

				//asigna valores al areglo bidimencional
				$datos[$tratado->tratadoid]['nombre']       = $tratado->nombre;
				$datos[$tratado->tratadoid]['nombrecorto']  = $tratado->nombrecorto;
				$datos[$tratado->tratadoid]['tipo']         = $tratado->tipo;
				$datos[$tratado->tratadoid]['clase']        = $tratado->clase;
				$datos[$tratado->tratadoid]['icono']        = $tratado->icono;
				$datos[$tratado->tratadoid]['contingentes'] = $tingentes;
				$datos[$tratado->tratadoid]['inscritos']    = count($empresas);

				if(count($contingentes) == 0)
					$contingentes = array(0);	
				
				//=== inscripciones
				$inscripciones = Solicitudinscripcion::getSolicitudes($contingentes);
				$datos[$tratado->tratadoid]['solicitudes']['inscripcion'] = array('Pendiente'=>0, 'Aprobada'=>0, 'Rechazada'=>0);
				foreach($inscripciones as $inscripcion) {
					$datos[$tratado->tratadoid]['solicitudes']['inscripcion'][$inscripcion->estado] = $inscripcion->cuenta;

					if($inscripcion->estado == 'Pendiente')
						$pendientesinscripcion += $inscripcion->cuenta;
				}

				//=== asignaciones
				$asignaciones = Solicitudasignacion::getSolicitudes($contingentes);
				$datos[$tratado->tratadoid]['solicitudes']['asignacion'] = array('Pendiente'=>0, 'Aprobada'=>0, 'Rechazada'=>0);
				foreach($asignaciones as $asignacion) {
					$datos[$tratado->tratadoid]['solicitudes']['asignacion'][$asignacion->estado] = $asignacion->cuenta;

					if($asignacion->estado == 'Pendiente')
						$pendientesasignacion += $asignacion->cuenta;
				}

				//=== emisiones
				$emisiones = Solicitudesemision::getSolicitudes($contingentes);
				$datos[$tratado->tratadoid]['solicitudes']['emision'] = array('Pendiente'=>0, 'Aprobada'=>0, 'Rechazada'=>0);
				foreach($emisiones as $emision) {
					$datos[$tratado->tratadoid]['solicitudes']['emision'][$emision->estado] = $emision->cuenta;

					if($emision->estado == 'Pendiente')
						$pendientesemision += $emision->cuenta;
				}
			}

			//retorna datos a la vista
			return View::make('dashboard.admin')
				->with('datos', $datos)
				->with('pendientesinscripcion', $pendientesinscripcion)
				->with('pendientesasignacion', $pendientesasignacion)
				->with('pendientesemision', $pendientesemision);
		}

		else {
			//captura empresaid
			$empresaid    = Auth::user()->empresaid;
			$grafica      = [];
			//consulta en db segun empresaid
			$contingentes = Empresacontingente::contingentesEmpresa($empresaid);

			//contruye la infomacion para el areglo grafica
			foreach ($contingentes as $contingente) {
				$grafica[$contingente->contingenteid]['esasignacion'] = $contingente->asignacion;
				$cys = Movimiento::getConsumoYSaldoActual($contingente->contingenteid, $empresaid);
				if (!$cys) {
					$grafica[$contingente->contingenteid]['empresa'] = 0;
					$grafica[$contingente->contingenteid]['otros'] = 0;
					$grafica[$contingente->contingenteid]['saldo'] = 0;
					continue;
				}

				$grafica[$contingente->contingenteid]['empresa']      = $cys->consumo;
				$grafica[$contingente->contingenteid]['otros']        = $cys->consumototal-$cys->consumo;
				if ($contingente->asignacion==1) {
					$grafica[$contingente->contingenteid]['saldo']     = $cys->asignado-$cys->consumo;
				}
				else {
					$grafica[$contingente->contingenteid]['saldo']        = $cys->total-$cys->consumototal;
				}
			}

			//retorna datos a la vista
			return View::make('dashboard.index')
				->with('admin', $admin)
				->with('contingentes', $contingentes)
				->with('grafica', $grafica)
				->with('emisiones', Solicitudesemision::getEmisionesPendientes($empresaid))
				->with('certificados', Movimiento::getCuantosCertificadosEmpresa($empresaid))
				->with('empresa', Empresa::find(Auth::user()->empresaid));
		}
	}

	public function changetratado($id) {
		//guarda valores a session
		Session::put('tselected', $id);
		return 'true';
	}

	public function detalletratado($id) {
		//captura id
		$id = Crypt::decrypt($id);

		//retorna datos a la vista
		return View::make('dashboard.productos')
			->with('info', Tratado::getTratadoDashboard($id))
			->with('productos', Contingente::getProductos($id));
	}
}