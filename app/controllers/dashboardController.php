<?php

class dashboardController extends BaseController {
	public function index() {
		$admin = in_array(Auth::user()->rolid, Config::get('contingentes.roladmin'));

		if($admin){
			$tratados = Tratado::getTratados();
			
			$datos = array();
			foreach($tratados as $tratado) {
				$contingentes = Contingente::getContingentesTratado($tratado->tratadoid);

				$saldo = 0;
				foreach($contingentes as $contingente) {
					$query       = DB::select(DB::raw('SELECT getSaldo('.$contingente.', 0) AS saldo'));
					$saldo += $query[0]->saldo;
				}

				$datos[$tratado->tratadoid]['nombre']       = $tratado->nombre;
				$datos[$tratado->tratadoid]['nombrecorto']  = $tratado->nombrecorto;
				$datos[$tratado->tratadoid]['tipo']         = $tratado->tipo;
				$datos[$tratado->tratadoid]['contingentes'] = count($contingentes);
				$datos[$tratado->tratadoid]['inscritos']    = 0;
				$datos[$tratado->tratadoid]['saldo']        = $saldo;

				if(count($contingentes) == 0)
					$contingentes = array(0);	
				
				//=== inscripciones
				$inscripciones = Usuariocontingente::getSolicitudes($contingentes);
				$datos[$tratado->tratadoid]['solicitudes']['inscripcion'] = array('Pendiente'=>0, 'Aprobada'=>0, 'Rechazada'=>'--');
				foreach($inscripciones as $inscripcion){
					if($inscripcion->activo == 0){
						$datos[$tratado->tratadoid]['solicitudes']['inscripcion']['Pendiente'] = $inscripcion->cuenta;
					}

					else{
						$datos[$tratado->tratadoid]['solicitudes']['inscripcion']['Aprobada']  = $inscripcion->cuenta;
						$datos[$tratado->tratadoid]['inscritos'] = $inscripcion->cuenta;
					}
				}

				//=== asignaciones
				$asignaciones = Solicitudasignacion::getSolicitudes($contingentes);
				$datos[$tratado->tratadoid]['solicitudes']['asignacion'] = array('Pendiente'=>0, 'Aprobada'=>0, 'Rechazada'=>0);
				foreach($asignaciones as $asignacion){
					$datos[$tratado->tratadoid]['solicitudes']['asignacion'][$asignacion->estado] = $asignacion->cuenta;
				}

				//=== emisiones
				$emisiones = Solicitudesemision::getSolicitudes($contingentes);
				$datos[$tratado->tratadoid]['solicitudes']['emision'] = array('Pendiente'=>0, 'Aprobada'=>0, 'Rechazada'=>0);
				foreach($emisiones as $emision){
					$datos[$tratado->tratadoid]['solicitudes']['emision'][$emision->estado] = $emision->cuenta;
				}
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