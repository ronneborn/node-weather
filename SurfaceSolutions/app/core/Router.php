<?php
namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, $handler, array $middleware = []): void
    {
        $this->add('GET', $path, $handler, $middleware);
    }

    public function post(string $path, $handler, array $middleware = []): void
    {
        $this->add('POST', $path, $handler, $middleware);
    }

    private function add(string $method, string $path, $handler, array $middleware): void
    {
        $this->routes[] = compact('method', 'path', 'handler', 'middleware');
    }

    public function dispatch(Request $request): void
    {
        $uri = rtrim($request->uri(), '/') ?: '/';
        $method = $request->method();

        foreach ($this->routes as $route) {
            if ($method !== $route['method']) {
                continue;
            }
            $pattern = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#', '(?P<$1>[^/]+)', rtrim($route['path'], '/') ?: '/');
            if (preg_match('#^' . $pattern . '$#', $uri, $matches)) {
                foreach ($route['middleware'] as $mw) {
                    (new $mw())->handle();
                }
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                [$class, $method] = $route['handler'];
                (new $class())->$method($params);
                return;
            }
        }

        http_response_code(404);
        echo 'Sidan hittades inte.';
    }
}
