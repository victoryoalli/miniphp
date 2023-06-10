<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../app/core/bootstrap.php';

use App\Core\{Router, Request};

Router::load('app/routes.php')->direct(Request::uri(), Request::method());
