<?php

return [
    'database' => env('DB_DATABASE', 'miniphp'),
    'username' => env('DB_USERNAME', 'root'),
    'password' => env('DB_PASSWORD', ''),
    'connection' => env('DB_CONNECTION', 'mysql'),
    'host' => '127.0.0.1',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
];
