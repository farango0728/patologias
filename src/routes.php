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

            $group->get('user', 'UserController:user')
                ->setName("user")
                ->add($container->get('AuthMiddleware'));
            $group->get('eps', 'EpsController:eps')
                ->setName("eps")
                ->add($container->get('AuthMiddleware'));
            
            $group->get('modality', 'ModalityController:modality')
                ->setName("modality")
                ->add($container->get('AuthMiddleware'));

        $group->group('orders/', function (RouteCollectorProxy $group) use ($container) {

        $group->get('all', 'OrderController:all')->setName("orden.all");
        $group->get('add', 'OrderController:add')->setName("orden.add");

        })->add($container->get('AuthMiddleware'));

        $group->group('users/', function (RouteCollectorProxy $group) use ($container) {

        $group->get('all', 'UserController:all')->setName("user.all");
        $group->get('add', 'UserController:add')->setName("user.add");

        })->add($container->get('AuthMiddleware'));

        $group->group('eps/', function (RouteCollectorProxy $group) use ($container) {

        $group->get('all', 'EpsController:all')->setName("eps.all");
        $group->get('add', 'EpsController:add')->setName("eps.add");

        })->add($container->get('AuthMiddleware'));

        $group->group('modality/', function (RouteCollectorProxy $group) use ($container) {

        $group->get('all', 'ModalityController:all')->setName("modality.all");
        $group->get('add', 'ModalityController:add')->setName("modality.add");

        })->add($container->get('AuthMiddleware'));

    })->add($container->get("viewMiddleware"));

};


