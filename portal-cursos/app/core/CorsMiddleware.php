<?php
// app/core/CorsMiddleware.php
// Middleware OBLIGATORIO #2: configura CORS de forma explícita para el
// consumo de la API propia desde el cliente (fetch).
// Se ejecuta ANTES de AuthMiddleware en las rutas /api/* para poder
// responder correctamente a la petición preflight (OPTIONS).

class CorsMiddleware
{
    // TODO: sustituir por el/los orígenes reales del cliente en producción
    private array $allowedOrigins = [
        'http://localhost:8000',
        'http://127.0.0.1:8000',
    ];

    public function handle(): void
    {
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';

        if (in_array($origin, $this->allowedOrigins, true)) {
            header('Access-Control-Allow-Origin: ' . $origin);
        }
        header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        header('Access-Control-Allow-Credentials: true');

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(204);
            exit; // corta aquí: no debe llegar al controlador
        }
    }
}
