<?php


namespace App\Middleware;


use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;

class GuestMiddleware extends Middleware
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler) : \Psr\Http\Message\ResponseInterface
    {
        if($this->container->get('auth')->check() and isset($this->container->get('auth')->user()['arroba_id'])) {
            $response = new Response();
            $routeParser = $this->container->get('routeParser');

            return $response->withHeader('Location', $routeParser->urlFor('home'))->withStatus(200);
        }

        $response = $handler->handle($request);
        return $response;
    }

}