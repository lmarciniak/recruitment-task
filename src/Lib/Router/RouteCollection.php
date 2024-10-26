<?php

declare(strict_types=1);

namespace App\Lib\Router;

class RouteCollection
{
    /**
     * @var array<string, Route>
     */
    private array $routes = [];

    public function __construct()
    {
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function addRoute(Route $route): self
    {
        $this->routes[$route->getPath()] = $route;

        return $this;
    }

    public function findRouteByPath(string $path): ?Route
    {
        return $this->routes[$path] ?? null;
    }
}