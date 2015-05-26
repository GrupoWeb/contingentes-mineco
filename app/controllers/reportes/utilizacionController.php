
/*
SELECT 
  e.nit, e.razonsocial, 
  (SELECT SUM(m2.cantidad) FROM movimientos m2 WHERE m2.periodoid=m.periodoid) AS adjudicado,
  m.created_at AS fecha, c.numerocertificado, c.fraccion, c.fechavencimiento, ABS(cantidad) AS cantidad,
  c.dua, c.real, c.cif 
FROM
  movimientos AS m
  LEFT JOIN authusuarios u ON m.usuarioid=u.usuarioid
  LEFT JOIN empresas e ON u.empresaid=e.empresaid
  LEFT JOIN certificados AS c ON m.certificadoid=c.certificadoid
WHERE
  tipomovimientoid = 2 AND periodoid=5
ORDER BY 
  e.razonsocial, m.created_at;
  */

<?php

class utilizacionController extends BaseController {
  
  public function index() {

  }

  public function store() {
    
  }
}