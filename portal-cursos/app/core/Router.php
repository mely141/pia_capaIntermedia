<?php
// app/core/Router.php
// Router mínimo: mapea "ruta" + "método HTTP" a Controlador::accion
// Todas las peticiones pasan primero por aquí, luego por el/los middleware(s)
// registrados en la ruta, y solo si pasan, llegan al controlador.

class Router
{
    private array $routes = [];

    public function add(string $method, string $path, callable $handler, array $middlewares = []): void
    {
        $this->routes[] = [
            'method'      => strtoupper($method),
            'path'        => $this->toRegex($path),
            'handler'     => $handler,
            'middlewares' => $middlewares,
        ];
    }

    public function get(string $path, callable $handler, array $middlewares = []): void
    {
        $this->add('GET', $path, $handler, $middlewares);
    }

    public function post(string $path, callable $handler, array $middlewares = []): void
    {
        $this->add('POST', $path, $handler, $middlewares);
    }

    private function toRegex(string $path): string
    {
        // Convierte /curso/{id} en un patrón con grupo nombrado (id)
        $pattern = preg_replace('#\{([a-zA-Z_]+)\}#', '(?P<$1>[^/]+)', $path);
        return '#^' . $pattern . '$#';
    }

    public function dispatch(string $uri, string $method): void
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = rtrim($uri, '/');
        if ($uri === '') {
            $uri = '/';
        }

        foreach ($this->routes as $route) {
            if ($route['method'] !== strtoupper($method)) {
                continue;
            }
            if (preg_match($route['path'], $uri, $matches)) {
                $params = array_filter($matches, fn($k) => !is_int($k), ARRAY_FILTER_USE_KEY);

                // Ejecutar middlewares en orden antes del controlador
                foreach ($route['middlewares'] as $middleware) {
                    $mw = new $middleware();
                    $mw->handle(); // debe hacer exit/redirect si no pasa
                }

                call_user_func($route['handler'], $params);
                return;
            }
        }

        http_response_code(404);
        require __DIR__ . '/../views/public/404.php';
    }
}
