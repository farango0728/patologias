<?php
declare(strict_types=1);

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $container = $app->getContainer();

    $app->group('/', function (RouteCollectorProxy $group) use ($container) {

        $group->get('', 'LoginController:renderLogin')->setName("renderLogin")
            ->add($container->get('GuestMiddleware'))
            ->add('csrf');
        $group->get('logout', 'HomeController:logout')->setName("logout");
        $group->post('', 'LoginController:login')->setName("login")
            ->add($container->get('CsrfMiddleware'))
            ->add('csrf');        
        $group->get('home', 'HomeController:home')
            ->setName("home")
            ->add($container->get('AuthMiddleware'));
        
        $group->get('orden', 'HomeController:orden')
        ->setName("orden")
        ->add($container->get('AuthMiddleware'));


    })->add($container->get("viewMiddleware"));

};


