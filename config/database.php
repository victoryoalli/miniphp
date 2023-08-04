<?php

return [
    'default' => 'mysql',
    'sqlsrv' => [
        'username' => env('DB_USERNAME', 'sa'),
        'password' => env('DB_PASSWORD', ''),
        'connection' => env('DB_CONNECTION', 'sqlsrv:Server=localhost;Database=Test;Encrypt=false'),
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ],
    ],
    'mysql' => [
        'username' => env('DB_USERNAME', 'root'),
        'password' => env('DB_PASSWORD', ''),
        'connection' => env('DB_CONNECTION', 'mysql:host=localhost;dbname=test'),
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ],
];
