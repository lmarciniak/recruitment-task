<?php

declare(strict_types=1);

namespace App\Lib\Router;

class Route
{
    public function __construct(
        private readonly string $path,
        private readonly string $controller,
        private readonly string $action,
        private readonly ?array $methods = null,
    )
    {

    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getMethods(): ?array
    {
        return $this->methods;
    }
}