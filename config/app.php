<?php

use Slim\Factory\AppFactory;
use DI\Container;

ini_set("session.cookie_lifetime","7200");
ini_set("session.gc_maxlifetime","7200");
session_start();

require_once dirname(__DIR__) . "/vendor/autoload.php";


$container = new Container();

$settings = require_once __DIR__ . "/settings.php";
$settings($container);

$logger = require_once __DIR__ . "/logger.php";
$logger($container);


$connections = require_once __DIR__. "/connection.php";
$connections($container);


AppFactory::setContainer($container);

$app = AppFactory::create();

//$app->setBasePath('/public');


$utilities =  require_once __DIR__ . "/utilities.php";
$utilities($app);

$middlewares = require_once __DIR__ . "/middleware.php";
$middlewares($app);

$views = require_once __DIR__ . "/views.php";
$views($app);

$controllers = require_once __DIR__ . "/controllers.php";
$controllers($app);

$routes = require_once dirname(__DIR__) . "/src/routes.php";
$routes($app);

$app->run();