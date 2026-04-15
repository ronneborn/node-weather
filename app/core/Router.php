<?php

declare(strict_types=1);


namespace App\Core;


class Router
{
    /** @var array<string, array<int, array{pattern:string, action:callable|array}>> */
    private array $routes = [];

    public function get(string $pattern, callable|array $action): void
    {
        $this->addRoute('GET', $pattern, $action);
    }

    public function post(string $pattern, callable|array $action): void
    {
        $this->addRoute('POST', $pattern, $action);
    }

    private function addRoute(string $method, string $pattern, callable|array $action): void
    {
        $this->routes[$method][] = [
            'pattern' => $pattern,
            'action' => $action,
        ];
    }

    public function dispatch(Request $request, Response $response): void
    {
        $method = $request->method();
        $uri = $request->uri();

        foreach ($this->routes[$method] ?? [] as $route) {
            $params = $this->match($route['pattern'], $uri);
            if ($params === null) {
                continue;
            }

            $action = $route['action'];

            if (is_callable($action)) {
                $action($request, $response, $params);
                return;
            }

            [$controllerClass, $controllerMethod] = $action;
            $controller = new $controllerClass($request, $response);
            $controller->{$controllerMethod}(...array_values($params));
            return;
        }

        $response->setStatusCode(404);
        View::render('errors/404', ['title' => 'Sidan hittades inte']);
    }

    private function match(string $pattern, string $uri): ?array
    {
        $regex = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_-]*)\}#', '(?P<$1>[^/]+)', $pattern);
        $regex = '#^' . rtrim($regex, '/') . '/?$#';

        if (!preg_match($regex, $uri, $matches)) {
            return null;
        }

        return array_filter(
            $matches,
            static fn ($key): bool => !is_int($key),
            ARRAY_FILTER_USE_KEY
        );
    }
}
