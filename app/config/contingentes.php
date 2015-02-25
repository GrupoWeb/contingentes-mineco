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

	'roladmin'        => array(1,2),
	'rolempresa'			=> array(3),
	'tratadosExclude' => array('cuentacorriente', 'empresas', 'login', 'reset','cancerbero','paises','productos','requerimientos','solicitud',''),

);
