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
    
    $container->set('OrderController', function () use ($container) {

        return new \App\Controllers\OrderController($container);

    }); 

    $container->set('UserController', function () use ($container) {

        return new \App\Controllers\UserController($container);

    }); 

   
    $container->set('LogicController', function () use ($container) {

        return new \App\Controllers\LogicController($container);

    });

    $container->set('StudyController', function () use ($container) {

        return new \App\Controllers\StudyController($container);

    });

};