<?php
return array(
	'fetch' => PDO::FETCH_CLASS,
	'default' => 'mysql',
	'connections' => array(
		'mysql' => array(
			'host'      => '127.0.0.1',
			'database'  => 'contingentes',
			'username'  => 'root',
			'password'  => 'root',
		),
	),
);
