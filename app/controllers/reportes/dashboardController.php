<?php

class dashboardController extends BaseController {
	public function index() {
		$admin = in_array(Auth::user()->rolid, Config::get('contingentes.roladmin'));

		if($admin){
			$tratados              = Tratado::getTratados();
			$pendientesinscripcion = 0;
			$pendientesasignacion  = 0;
			$pendientesemision     = 0;
			$datos                 = array();

			foreach($tratados as $tratado) {
				$contingentes = Contingente::getContingentesTratado($tratado->tratadoid);
				$empresas     = Tratado::getEmpresasTratado($tratado->tratadoid);
				//dd(DB::getQueryLog());
				$tingentes             = array();
				foreach($contingentes as $contingente) {
					$asignacion = Contingente::getTipoTratado($contingente);
					if($asignacion == 0)
						$query = DB::select(DB::raw('SELECT getSaldo('.$contingente.', 0) AS saldo'));
					else
						$query = DB::select(DB::raw('SELECT getSaldoAsignacion('.$contingente.', 0) AS saldo'));
					
					$inscritos   = Empresacontingente::getEmpresasContingente($contingente);
					//dd(DB::getQueryLog());
					$tingentes[] = array(
						'contingenteid' => $contingente,
						'nombre'        => Contingente::getProducto($contingente),
						'saldo'         => ($query?$query[0]->saldo:0),
						'inscritos'     => count($inscritos)
					);
				}

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

			return View::make('dashboard.admin')
				->with('datos', $datos)
				->with('pendientesinscripcion', $pendientesinscripcion)
				->with('pendientesasignacion', $pendientesasignacion)
				->with('pendientesemision', $pendientesemision);
		}

		else {
			$empresaid = Auth::user()->empresaid;
			$graficas = array();
			$contingentes = Empresacontingente::contingentesEmpresa($empresaid);
			foreach ($contingentes as $contingente) {
				//dd($contingente->contingenteid);
				$cys = Movimiento::getConsumoYSaldo($contingente->contingenteid,$empresaid);
				var_dump($cys);
			}

			return View::make('dashboard.index')
				->with('admin', $admin)
				->with('contingentes', $contingentes)
				->with('emisiones', Solicitudesemision::getEmisionesPendientes($empresaid))
				->with('certificados', Movimiento::getCuantosCertificadosEmpresa($empresaid));
		}
	}

	public function changetratado($id) {
		Session::put('tselected', $id);
		return 'true';
	}

	public function detalletratado($id) {
		$id = Crypt::decrypt($id);

		return View::make('dashboard.productos')
			->with('info', Tratado::getTratadoDashboard($id))
			->with('productos', Contingente::getProductos($id));
	}
}