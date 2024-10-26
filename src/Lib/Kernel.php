<?php

declare(strict_types=1);

namespace App\Lib;

use App\Lib\Router\Router;
use GuzzleHttp\Psr7\Response;

class Kernel
{
    public function __construct(private readonly Router $router)
    {

    }

    public function run(): Response
    {
        return $this->router->run();
    }

    public function send(Response $response): void
    {
        $line = sprintf('HTTP/%s %s %s',
            $response->getProtocolVersion(),
            $response->getStatusCode(),
            $response->getReasonPhrase()
        );
        header($line, true, $response->getStatusCode());
        foreach ($response->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                header("{$name}: {$value}", false);
            }
        }
        $stream = $response->getBody();
        if ($stream->isSeekable()) {
            $stream->rewind();
        }
        while (!$stream->eof()) {
            echo $stream->read(1024 * 8);
        }
    }
}
