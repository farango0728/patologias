<?php

declare(strict_types=1);

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\App;
use Slim\Views\TwigMiddleware;


return function (App $app) {
    $settings = $app->getContainer()->get('settings');
    $container = $app->getContainer();

    $app->addErrorMiddleware(
        $settings['displayErrorDetails'],
        $settings['logErrorDetails'],
        $settings['logErrors']
    );

    $responseFactory = $app->getResponseFactory();

    $container->set('csrf', function () use ($responseFactory){
        $csrf = new \Slim\Csrf\Guard($responseFactory);
        $csrf->setPersistentTokenMode(true);
        $csrf->setFailureHandler(function (ServerRequestInterface $request, RequestHandlerInterface $handler) {
            $request = $request->withAttribute("csrf_status", 0);
            return $handler->handle($request);
        });
        return $csrf;
    });
    $container->set('viewMiddleware', function () use ($app, $container) {

        return new TwigMiddleware($container->get('view'), $app->getRouteCollector()->getRouteParser());

    });

    $container->set('CsrfMiddleware', function () use ($container) {
        return new \App\Middleware\CsrfMiddleware($container);
    });


    $container->set('AuthMiddleware', function () use ($container) {
        return new \App\Middleware\AuthMiddleware($container);
    });


    $container->set('GuestMiddleware', function () use ($container) {
        return new \App\Middleware\GuestMiddleware($container);
    });

};