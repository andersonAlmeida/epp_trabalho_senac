<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Eloquent config
        'db' => [
            'driver' => 'pgsql',
            'host' => 'localhost',
            'database' => 'apis_e_frameworks_2019-2-n',
            'username' => 'postgres',
            'password' => 'postgres',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],

        "jwt" => [
            'secret' => 'progInternet2Noite20191'
        ]
    ],
];
