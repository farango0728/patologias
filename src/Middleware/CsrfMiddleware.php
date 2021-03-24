<?php
declare(strict_types = 1);
namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;

class CsrfMiddleware extends Middleware
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler) : \Psr\Http\Message\ResponseInterface
    {
        $response = $handler->handle($request);
        if($request->getAttribute('csrf_status') === 0) {
            $routeParser = $this->container->get('routeParser');
            return $response->withHeader('Location', $routeParser->urlFor('renderLogin'))->withStatus(200);
        }
        return $response;
    }
}