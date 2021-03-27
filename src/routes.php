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

            $group->get('study', 'StudyController:study')
            ->setName("study")
            ->add($container->get('AuthMiddleware'));
          
            $group->get('array1', 'LogicController:array1')
            ->setName("array1")
            ->add($container->get('AuthMiddleware'));

        $group->group('orders/', function (RouteCollectorProxy $group) use ($container) {

        $group->get('all', 'OrderController:all')->setName("orden.all");
        
        $group->get("show/{id}", "OrderController:show")->setName("order.show");

        })->add($container->get('AuthMiddleware'));

        $group->group('users/', function (RouteCollectorProxy $group) use ($container) {

        $group->get('all', 'UserController:all')->setName("user.all");
        $group->get('add', 'UserController:add')->setName("user.add");

        })->add($container->get('AuthMiddleware'));

        $group->group('study/', function (RouteCollectorProxy $group) use ($container) {

        $group->get('all', 'StudyController:all')->setName("study.all");
        $group->post("add", "StudyController:add")->setName("study.add");

        })->add($container->get('AuthMiddleware'));

    })->add($container->get("viewMiddleware"));

};


