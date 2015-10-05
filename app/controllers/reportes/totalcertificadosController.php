<?php

class totalcertificadosController extends Controller {

  public function index() {
    return View::make('reportes.filtroscertificado')
      ->with('titulo', 'Certificados')
      ->with('tratados', Tratado::getTratados())
      ->with('filters', array('tratados', 'contingentes', 'periodos', 'empresas', 'fechaini', 'fechafin'))
      ->with('todos',['tratados']);
  }

  public function getContingente($tid){
    $contingentes = Contingente::getContTratado($tid);
    return $contingentes;
  }
  

  public function store() {
    $tratados      = null;
    $datos         = array();
    $tratadoid     = Crypt::decrypt(Input::get('tratadoid'));
    $contingenteid = Crypt::decrypt(Input::get('contingenteid'));
    $periodoid     = Crypt::decrypt(Input::get('periodoid'));
    $empresaid     = Crypt::decrypt(Input::get('empresaid'));
    $fechaini      = Components::fechaHumanoAMySql(Input::get('fechaini')).' 00:00';
    $fechafin      = Components::fechaHumanoAMySql(Input::get('fechafin')).' 23:59';
    $formato       = Input::get('formato');

    if($tratadoid == -1){
      $tratados = Tratado::getTratados();
      foreach ($tratados as $key) {
        $arrayContingentes = array();
        $contingentes = $this->getContingente($key->tratadoid);
        foreach ($contingentes as $value) {
          $certificado = Certificado::getCertificados($key->tratadoid, $value->contingenteid, $periodoid, $empresaid, $fechaini, $fechafin);
          array_push($arrayContingentes, array($value,$certificado));
         }
         array_push($datos, array($key->nombrecorto, $arrayContingentes));
      }
    }else{
      //obtiene el nombre corto del tratado 
      $tratados = Tratado::getNombre($tratadoid);
      $arrayContingentes = array();
      if ($contingenteid == -1) {
        $contingentes = $this->getContingente($tratadoid);
        foreach ($contingentes as $value) {
          $certificado = Certificado::getCertificados($tratadoid, $value->contingenteid, $periodoid, $empresaid, $fechaini, $fechafin);
          if (!empty($certificado)) {
            array_push($arrayContingentes, array($value,$certificado));  
          }
        }
        array_push($datos, array($tratados, $arrayContingentes));
      }else{
        $contingente = Contingente::getContingente($contingenteid);
        foreach ($contingente as $value) {
          $certificado = Certificado::getCertificados($tratadoid, $contingenteid, $periodoid, $empresaid, $fechaini, $fechafin);
          array_push($arrayContingentes, array($value,$certificado));
        }
        
        array_push($datos, array($tratados, $arrayContingentes));
      }
    }

    if ($formato == "html") {
      return View::make('reportes.totalcertificados')
        ->with('titulo', 'Total Certificados')
        ->with('formato', $formato)
        ->with('datos', $datos);
    }else{

      PDF::SetTitle('Cuenta Corriente - Contingentes');
      PDF::AddPage();
      PDF::setLeftMargin(20);

      $html = View::make('reportes.totalcertificadospdf')
        ->with('titulo', 'Total Certificados')
        ->with('formato', $formato)
        ->with('datos', $datos);

      PDF::writeHTML($html, true, false, true, false, '');
      PDF::Output('CC-Contingente.pdf');

    }
  }

}