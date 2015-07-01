<?php
class Numeroaletras {

  private $letra;
  private $convertidos = array();
  private $digitos     = array();

  public function __construct($valor) {
    $partido            = explode(".",$valor);
    $numero             = reset($partido);
    $decimal            = end($partido);

    if($numero == "")
      $numero=0;

    $largo         = strlen($numero);
    $lugares       = ceil($largo/3);
    $this->lugares = $lugares;
    $alreves       = strrev($numero);

    $dadosvuelta[] = strrev($decimal);
    for($i=0;$i<$lugares;$i++)
      $dadosvuelta[] = substr($alreves,$i*3,3);

    for($j=0;$j<count($dadosvuelta);$j++)
      $this->digitos[] = strrev($dadosvuelta[$j]);

    for ($h=0;$h<count($this->digitos);$h++)
      $this->convertidos[] = $this->convertir($this->digitos[$h]);

    $posiciones = array(0=>'punto', 1=>'', 2=>'mil', 3=>'millones');
    $letras     = ''; 
    for($i=count($this->convertidos)-1; $i>=0; $i--) {
      if($i <> 0)
        $letras .= $this->convertidos[$i].' '.$posiciones[$i].' ';
      else
        $letras .= $posiciones[$i].' '.$this->convertidos[$i].' ';
    }

    $this->letra = $letras;
  }


  private function convertir($numero) {
    $unidades = array("uno","dos","tres","cuatro","cinco","seis","siete","ocho","nueve",
            "diez","once","doce","trece","catorce","quince","dieciseis","diecisiete",
            "dieciocho","diecinueve","veinte");
    $decenas  = array("veinti","treinta","cuarenta","cincuenta","sesenta","setenta","ochenta","noventa");
    $centenas = array("ciento","doscientos","trescientos","cuatrocientos","quinientos","seiscientos",
                    "setecientos","ochocientos","novecientos");
    if ($numero == 0 || $numero == "")
      return "cero";

    elseif ($numero<100) {
      if($numero<=20){
        if(substr($numero, 0, 1) == 0)
          return 'cero '.$unidades[$numero-1];

        else
          return $unidades[$numero-1];
      }

      else {
        $dec=$numero/10;
        if((int)$dec>2 && $numero%10!=0)
          $espacio=" y ";
        
        $unid = $numero%10;
        return $decenas[$dec-2].$espacio.$unidades[$unid-1];  
        $espacio="";    
      }
    }

    else {
      $cent = $numero/100;
      
      if($numero%100>20) {
        $dec=($numero%100)/10;
       
        if((int)$dec>2 && ($numero%100)%10)
          $espacio = " y ";
       
        $unid = ($numero%10);
        return $centenas[$cent-1]." ".$decenas[$dec-2].$espacio.$unidades[$unid-1];
        $espacio="";
      }

      else {
        $dec    = $numero%100;
        $moment = $this->nrosRaros($centenas[$cent-1]." ".$unidades[$dec-1]);
        return $moment;
      }    
    }
  }

  public function getLetras() {
    return strtoupper($this->letra);
  }
}
