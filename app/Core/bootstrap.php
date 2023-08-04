<?php

use App\Core\App;
use App\Core\Database\{QueryBuilder, Connection};

loadEnv(__DIR__.'/../../.env');

App::bind('config.app', loadConfig('app'));
App::bind('config.database', loadConfig('database'));

// Get the database configuration.
$dbConfig = App::get('config.database');

// Create connections for 'main' and 'test'.
$mainConnection = Connection::make($dbConfig['default'], $dbConfig);
$testConnection = Connection::make('sqlsrv', $dbConfig);

// Bind the query builders for each connection.
App::bind('database', new QueryBuilder($mainConnection));
App::bind('database.test', new QueryBuilder($testConnection));
