<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Roles administradores
	|--------------------------------------------------------------------------
	|
	| Que roles pueden ver las notificaciones del dashboard con solicitudes
	| pendientes.
	|
	*/

	'roladmin'        => array(1,2,4),
	'rolempresa'			=> array(3),
	'tratadosExclude' => array('cuentacorriente', 'login', 'reset','cancerbero','paises',
		'productos','requerimientos','solicitud','', 'unidadesmedida','inicio', 
		'usuarios', 'usuarioempresas', 'roles','cuentacorrienteempresas','usuariosextra',
		'utilizacion','utilizacionporempresa','utilizacionporempresagrafica','consolidadoutilizacion',
		'buscarcertificados', 'certificados','editardatosempresa'),
	'variospaises'    => 8,
);
