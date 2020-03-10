<?php

return [
    'fetch'       => PDO::FETCH_CLASS,
    'default'     => 'mysql',
    'connections' => [
        'mysql' => [
            'host'     => 'host.docker.internal',
            'database' => 'contingentes',
            'username' => 'root',
            'password' => 'secret',
        ],
    ],
];
