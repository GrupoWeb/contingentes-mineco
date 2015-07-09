<?php

class utilizacionempresagraficaController extends BaseController {
  
  public function index() {
    return View::make('reportes.filtros')
      ->with('titulo', 'Grafica utilización de contingentes por empresa')
      ->with('tratados', Tratado::getTratados())
      ->with('filters', array('solotratados'));
  }

  public function store() {
    try {
      $tratadoid     = Crypt::decrypt(Input::get('tratadoid'));
      $contingenteid = Crypt::decrypt(Input::get('contingentes'));
    } catch (Exception $e) {
      return 'Tratado, contingente o empresa inválida.';
    }

    $formato       = Input::get('formato');

    $movimientos   = Movimiento::getUtilizacionEmpresas($tratadoid, $contingenteid);
    $autorizado    = DB::table('tiposmovimiento')->where('nombre', 'Asignación')->pluck('tipomovimientoid');
    $certificado   = DB::table('tiposmovimiento')->where('nombre', 'Certificado')->pluck('tipomovimientoid');
    $activado      = DB::table('tiposmovimiento')->where('nombre', 'Cuota')->pluck('tipomovimientoid');

    $data          = array();
    $asignacion    = 0;

    foreach($movimientos as $movimiento) {
      $asignacion = $movimiento->asignacion;
      if($asignacion == 1) {
        if($movimiento->tipomovimientoid == $autorizado || $movimiento->tipomovimientoid == $certificado) {
          $vals = array(
            'asignado'  => (isset($data[$movimiento->nombre][$movimiento->razonsocial]['asignado']) ? $data[$movimiento->nombre][$movimiento->razonsocial]['asignado'] : 0),
            'emitido'   => (isset($data[$movimiento->nombre][$movimiento->razonsocial]['emitido']) ? $data[$movimiento->nombre][$movimiento->razonsocial]['emitido'] : 0)
          );

          if($movimiento->tipomovimientoid == $autorizado)
            $vals['asignado'] = $movimiento->monto;

          if($movimiento->tipomovimientoid == $certificado)
            $vals['emitido'] = $movimiento->monto;
         
          $data[$movimiento->razonsocial] = $vals;
        }
      }

      else {
        if($movimiento->tipomovimientoid == $activado || $movimiento->tipomovimientoid == $certificado) {
          $vals = array(
            'emitido'   => (isset($data[$movimiento->nombre][$movimiento->razonsocial]['emitido']) ? $data[$movimiento->nombre][$movimiento->razonsocial]['emitido'] : 0)
          );

          if($movimiento->tipomovimientoid == $certificado)
            $data[$movimiento->razonsocial] = $movimiento->monto;

          else
            $data['Activación de contingente'] = $movimiento->monto;
        }
      }
    }
    
    return View::make('reportes.utilizacionporempresagrafica')
      ->with('movimientos', $data)
      ->with('asignacion', $asignacion)
      ->with('titulo', 'Gráfica utilización de contingentes por empresa')
      ->with('tratado', Tratado::getNombre($tratadoid))
      ->with('producto', Contingente::getProducto($contingenteid))
      ->with('formato', $formato);
  }
}