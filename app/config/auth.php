<?php

return array(
	'driver' => 'eloquent',
	
	'model' => 'Authusuario',
	
	'table' => 'authusuarios',
	
	'reminder' => array(

		'email' => 'emails.auth.reminder',

		'table' => 'password_reminders',

		'expire' => 60,

	),

);
