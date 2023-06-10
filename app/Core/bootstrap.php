<?php

use App\Core\App;
use App\Core\Database\{QueryBuilder, Connection};

loadEnv(__DIR__.'/../../.env');

App::bind('config.app', loadConfig('app'));
App::bind('config.database', loadConfig('database'));

App::bind('database', new QueryBuilder(
    Connection::make(App::get('config.database'))
));
