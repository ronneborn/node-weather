<?php
namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, array $action, array $middleware = []): void
    {
        $this->add('GET', $path, $action, $middleware);
    }

    public function post(string $path, array $action, array $middleware = []): void
    {
        $this->add('POST', $path, $action, $middleware);
    }

    private function add(string $method, string $path, array $action, array $middleware): void
    {
        $this->routes[] = compact('method', 'path', 'action', 'middleware');
    }

    public function dispatch(Request $request): void
    {
        foreach ($this->routes as $route) {
            $params = $this->match($route['path'], $request->uri());
            if ($route['method'] === $request->method() && $params !== null) {
                foreach ($route['middleware'] as $middlewareClass) {
                    (new $middlewareClass())->handle($request);
                }
                [$controller, $method] = $route['action'];
                (new $controller())->{$method}($request, ...array_values($params));
                return;
            }
        }

        http_response_code(404);
        echo '404 - Sidan hittades inte';
    }

    private function match(string $routePath, string $uri): ?array
    {
        $pattern = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#', '(?P<$1>[^/]+)', $routePath);
        $pattern = '#^' . $pattern . '$#';

        if (preg_match($pattern, $uri, $matches)) {
            return array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
        }
        return null;
    }
}
