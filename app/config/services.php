<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
     */

    'mailgun'  => [
        'domain' => 'mailgun.mineco.gob.gt',
        'secret' => 'key-f996f7b8526574618',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'stripe'   => [
        'model'  => 'User',
        'secret' => '',
    ],
    'sat'      => [
        //'url'      => 'https://farm3.sat.gob.gt/mineco-ws/rest/privado/mineco/',
        'url'      => 'https://10.1.0.40/mineco-ws/rest/privado/mineco/',
        'usuario'  => '26480093',
        'password' => 'Mineco@2020',
    ],

];
