<?php

class importerController extends BaseController {

	public function import() {

		Excel::load('contingentes.csv', function($reader) {			
			$results = $reader->all();
	    
	    foreach($results as $result) {
				$tratado     = Tratado::firstOrNew(array('nombrecorto' => $result->tratado));
				$producto    = Producto::firstOrNew(array('nombre'=>$result->producto));

				dd($producto);

				$datos = array('tratadoid'=>$tratado->tratadoid, 
					'tipotratadoid'=>$result->tipo, 'productoid'=>$producto->productoid);
				dd($datos);
				$contingente = Contingente::firstOrNew(array('tratadoid'=>$tratado->tratadoid, 
					'tipotratadoid'=>$result->tipo, 'productoid'=>$producto->productoid));

				dd($contingente);

				$cp                = new Contingentepartida;
				$cp->contingenteid = $contingente->contingenteid;
				$cp->partida       = $result->partida;
				$cp->nombre        = $result->nombre <> '' ? $result->nombre : '-';
				$cp->save();

				$periodo                = new Periodo;
				$periodo->nombre        = $tratado->nombrecorto.' '.$producto->nombre;
				$periodo->contingenteid = $contingente->contingenteid;
				$periodo->fechainicio   = '2015-01-01';
				$periodo->fechafin      = '2015-12-31';
				$periodo->save();

				if($result->tipo == 1) {
					$m              = new Movimiento;
					$m->periodoid   = $periodo->periodoid;
					$m->cantidad    = $result->cantidad;
					$m->descripcion = 'Saldo inicial';
					$m->save();
				}
	    }
		});

	}
}