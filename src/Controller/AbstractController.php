<?php

declare(strict_types=1);

namespace App\Controller;

use App\Lib\View\View;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;

class AbstractController
{
    public function __construct(protected ServerRequest $request)
    {

    }

    protected function render(string $path, array $data = [], int $status = 200): Response
    {
        $view = new View();;
        ob_start();
        $view->render($path, $data);
        $output = ob_get_contents();
        ob_end_clean();

        return new Response(
            $status,
            ['Content-Type' => 'text/html'],
            $output
        );
    }
}