<?php
declare(strict_types=1);


use App\Auth\Auth;
use Slim\App;
use SlimSession\Helper;

return function (App $app) {
    $container = $app->getContainer();

    $container->set('routeParser', function () use ($app) {
        return $app->getRouteCollector()->getRouteParser();
    });

    $container->set('auth', function () use ($container) {
        return new Auth();
    });

};