<?php

class utilizacionempresagraficaController extends BaseController {
  
  public function index() {
    //retorna datos la vista
    return View::make('reportes.filtros')
      ->with('titulo', 'Grafica utilización de contingentes por empresa')
      ->with('tratados', Tratado::getTratados())
      ->with('filters', array('contingentes','tratados','periodos'))
      ->with('todos', array());
  }

  public function store() {

    try {
      //asigna valores del formulario
      $tratadoid     = Crypt::decrypt(Input::get('tratadoid'));
      $contingenteid = Crypt::decrypt(Input::get('cmbContingente'));
      $periodoid     = Crypt::decrypt(Input::get('cmbPeriodo'));

    } catch (Exception $e) {
      
      //valida formato pdf
      if(!empty($_REQUEST['svg'])){
        PDF::SetTitle('Gráfica utilización de contingentes por empresa');
        PDF::AddPage('L');
        PDF::setLeftMargin(20);
        if (Input::get('pie') == 1) {
          PDF::imageSVG('@'.$_REQUEST['svg'], $x=10, $y=50, $w='', $h=150, $link='', $align='', $palign='', $border=0, $fitonpage=false);  
        }else{
          PDF::imageSVG('@'.$_REQUEST['svg'], $x=45, $y=70, $w=200, $h=100);
        }
        

        $html = View::make('reportes.utilizacionporempresagraficapdf')
          ->with('titulo', 'Gráfica utilización de contingentes por empresa')
          ->with('tratado', Input::get('tratado'))
          ->with('producto', Input::get('producto'));

        PDF::writeHTML($html, true, false, true, false, '');
        PDF::Output('grafica-utilizacion-contingentes.pdf');
      }else{
        return View::make('cancerbero::error')
        ->with('mensaje','Tratado, período o contingente inválido.');
      }
    }

    //asigna valores a las variables
    $formato     = Input::get('formato');
    $movimientos = Movimiento::getUtilizacionEmpresas($periodoid, 0);
    $tratado     = Contingente::getTratado($contingenteid);

    //retorna datos a la vista
    return View::make('reportes.utilizacionporempresagrafica')
      ->with('movimientos', $movimientos)
      ->with('esAsignacion', $tratado->asignacion)
      ->with('titulo', 'Gráfica utilización de contingentes por empresa')
      ->with('tratado', $tratado->nombre)
      ->with('producto', Contingente::getProducto($contingenteid))
      ->with('formato', $formato);
  }
}