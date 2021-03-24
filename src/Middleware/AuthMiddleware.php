<?php


namespace App\Middleware;


use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;

class AuthMiddleware extends Middleware
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler) : \Psr\Http\Message\ResponseInterface
    {
        if(! $this->container->get('auth')->check() or is_null($this->container->get('auth')->user()['id'])) {
            $response = new Response();
            $routeParser = $this->container->get('routeParser');
            return $response->withHeader('Location', $routeParser->urlFor('renderLogin'))->withStatus(200);
        }
        $response = $handler->handle($request);
        return $response;
    }
}