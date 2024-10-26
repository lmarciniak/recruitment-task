<?php

declare(strict_types=1);

namespace App\Lib\View;

class View
{
    public function __construct(protected array $data = [])
    {

    }

    public function render(string $path, array $data = []): void
    {
        $this->data = $data;
        require dirname(__DIR__) . "/../templates/{$path}";
    }

    public function partial(string $path, array $data = []): void
    {
        (clone $this)->render($path, $data);;
    }
}