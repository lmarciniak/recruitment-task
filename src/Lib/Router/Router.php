<?php

declare(strict_types=1);

namespace App\Lib\Router;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;

class Router
{
    public function __construct(private readonly RouteCollection $routeCollection)
    {

    }

    public function run(): ?Response
    {
        $request = ServerRequest::fromGlobals();
        $route = $this->routeCollection->findRouteByPath($request->getUri()->getPath());
        if (
            empty($route) || empty($route->getController()) || empty($route->getAction()) ||
            !class_exists($route->getController()) || !method_exists($route->getController(), $route->getAction())
        ) {
            return new Response(404);
        }
        /** @var Response $response */
        $response = (new ($route->getController())($request))->{$route->getAction()}();

        return $response;
    }
}
