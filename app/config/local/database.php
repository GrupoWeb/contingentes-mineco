<?php
return array(
	'fetch' => PDO::FETCH_CLASS,
	'default' => 'mysql',
	'connections' => array(
		'mysql' => array(
			'host'      => 'localhost',
			'database'  => 'contingentes',
			'username'  => 'root',
			'password'  => 'root',
		),
	),
);
