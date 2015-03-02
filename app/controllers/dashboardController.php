<?php

class dashboardController extends BaseController {
	public function index() {
		$admin = in_array(Auth::user()->rolid, Config::get('contingentes.roladmin'));

		if($admin){
			$tratados = Tratado::getTratados();
			
			$datos = array();
			foreach($tratados as $tratado) {
				$contingentes = Contingente::getContingentesTratado($tratado->tratadoid);
				$empresas     = Tratado::getUsuariosTratado($tratado->tratadoid);

				$tingentes = array();
				foreach($contingentes as $contingente) {
					$query       = DB::select(DB::raw('SELECT getSaldo('.$contingente.', 0) AS saldo'));
					$inscritos   = Usuariocontingente::getUsuariosContingente($contingente);
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
				foreach($inscripciones as $inscripcion)
					$datos[$tratado->tratadoid]['solicitudes']['inscripcion'][$inscripcion->estado] = $inscripcion->cuenta;

				//=== asignaciones
				$asignaciones = Solicitudasignacion::getSolicitudes($contingentes);
				$datos[$tratado->tratadoid]['solicitudes']['asignacion'] = array('Pendiente'=>0, 'Aprobada'=>0, 'Rechazada'=>0);
				foreach($asignaciones as $asignacion)
					$datos[$tratado->tratadoid]['solicitudes']['asignacion'][$asignacion->estado] = $asignacion->cuenta;

				//=== emisiones
				$emisiones = Solicitudesemision::getSolicitudes($contingentes);
				$datos[$tratado->tratadoid]['solicitudes']['emision'] = array('Pendiente'=>0, 'Aprobada'=>0, 'Rechazada'=>0);
				foreach($emisiones as $emision)
					$datos[$tratado->tratadoid]['solicitudes']['emision'][$emision->estado] = $emision->cuenta;
			}

			return View::make('dashboard.admin')
				->with('datos', $datos);
		}
		
		return View::make('dashboard.index')
			->with('admin', $admin);
	}

	public function changetratado($id) {
		Session::put('tselected', $id);
		return 'true';
	}
}