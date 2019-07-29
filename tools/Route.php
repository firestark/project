<?php

namespace Firestark;

use League\Route\Router;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Psr\Http\Server\MiddlewareInterface as Middleware;

class Route implements Middleware
{
    private $router = null;
    
    public function __construct(Router $router)
    {
        $this->router = $router;
    }
    
    public function process(Request $request, Handler $handler): Response
    {
        return $this->router->dispatch($request);
    }
}   