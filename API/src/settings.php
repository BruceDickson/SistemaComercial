<?php
return [
    'settings' => [
        'displayErrorDetails' => true,

        'logger' => [
            'name' => 'slim-app',
            'level' => Monolog\Logger::DEBUG,
            'path' => __DIR__ . '/../logs/app.log',
        ],
         // Database
        'db' => [
            'host' => 'localhost',
            'user' => 'bruce',
            'pass' => '9945',
            'dbname' => 'sistemacomercial'
        ],
    ],
];