<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
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

        //DB settings
        'db' => [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'consulmed',
            'username'  => 'sight',
            'password'  => 'sightinfo',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],
        //secret
        'secretKey' => 'ea767576fc03ebb3907330e03cb24400d27475b4'
    ],
];

 /*'conn' => new \PDO(
            "mysql:host=localhost;dbname=slim;charset=utf8",
            "sight",
            "sightinfo" */

