<?php

declare(strict_types=1);


namespace App\Core;


abstract class Controller
{
    protected Request $request;
    protected Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    protected function view(string $view, array $data = [], string $layout = 'layouts/frontend'): void
    {
        View::render($view, $data, $layout);
    }
}
