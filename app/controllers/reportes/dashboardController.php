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

				$tingentes             = array();
				foreach($contingentes as $contingente) {
					$asignacion = Contingente::getTipoTratado($contingente);
					
					if($asignacion == 0)
						$query = DB::select(DB::raw('SELECT getSaldo('.$contingente.', 0) AS saldo'));
					else
						$query = DB::select(DB::raw('SELECT getSaldoAsignacion('.$contingente.', 0) AS saldo'));
					
					$inscritos   = Empresacontingente::getEmpresasContingente($contingente);
					$tingentes[] = array(
						'contingenteid' => $contingente,
						'nombre'        => Contingente::getProducto($contingente),
						'saldo'         => $query[0]->saldo,
						'inscritos'     => count($inscritos)
					);
				}

				$datos[$tratado->tratadoid]['nombre']       = $tratado->nombre;
				$datos[$tratado->tratadoid]['nombrecorto']  = $tratado->nombrecorto;
				$datos[$tratado->tratadoid]['tipo']         = $tratado->tipo;
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
			return View::make('dashboard.index')
				->with('admin', $admin)
				->with('contingentes', Empresacontingente::getContingentesEmpresa(Auth::user()->empresaid))
				->with('emisiones', Solicitudesemision::getEmisionesUsuario(Auth::id()))
				->with('toneladas', Movimiento::getToneladasUsuario(Auth::id()))
				->with('tratados', Tratado::getTratadosDashboard())
				->with('productos', Contingente::getProductos());
		}
	}

	public function changetratado($id) {
		Session::put('tselected', $id);
		return 'true';
	}
}