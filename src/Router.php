<?php

namespace Src;

class Router
{
    private array $routes = [];

    public function add(string $method, string $route, $handler)
    {
        // Convert {id} into regex pattern
        $pattern = preg_replace('/{([^}]+)}/', '([^/]+)', $route);
        $pattern = "#^" . $pattern . "$#";

        $this->routes[] = [
            'method'  => strtoupper($method),
            'route'   => $route,
            'pattern' => $pattern,
            'handler' => $handler
        ];
    }

    public function run()
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // Detect project base path automatically
        $scriptName = dirname($_SERVER['SCRIPT_NAME']);
        $requestUri = "/" . trim(str_replace($scriptName, '', $requestUri), "/");

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && preg_match($route['pattern'], $requestUri, $matches)) {
                array_shift($matches);

                if (!is_callable($route['handler'])) {
                    throw new \InvalidArgumentException("Handler must be callable");
                }

                return call_user_func_array($route['handler'], $matches);
            }
        }

        // Default 404 response
        http_response_code(404);
        echo json_encode([
            "success" => false,
            "error" => "Route not found",
            "requested" => $requestUri
        ]);
    }
}
