<?php

require_once dirname(__DIR__).'/vendor/autoload.php';
require_once dirname(__DIR__).'/config/routes.php';
require_once dirname(__DIR__).'/config/app.php';

use App\Lib\Kernel;
use App\Lib\Router\Router;

$kernel = new Kernel(new Router($routeCollection));
$response = $kernel->run();
$kernel->send($response);
