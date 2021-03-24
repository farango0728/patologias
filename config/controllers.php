<?php
declare(strict_types = 1);

use Slim\App;

return function (App $app) {

    $container = $app->getContainer();


    $container->set('LoginController', function () use ($container) {

        return new \App\Controllers\LoginController($container);

    });    

    $container->set('HomeController', function () use ($container) {

        return new \App\Controllers\HomeController($container);

    });    

};