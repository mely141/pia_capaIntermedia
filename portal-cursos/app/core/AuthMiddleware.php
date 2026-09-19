<?php
// app/core/AuthMiddleware.php
// Middleware OBLIGATORIO #1: valida que exista sesión activa antes de
// llegar al controlador. La validación de ROL específico se hace con
// RoleMiddleware (ver RoleMiddleware.php) para poder componerlos por ruta.
//
// Orden de ejecución esperado en las rutas protegidas:
//   1) AuthMiddleware   -> ¿hay sesión?
//   2) RoleMiddleware    -> ¿el rol de la sesión puede entrar aquí?
//   3) Controlador

class AuthMiddleware
{
    public function handle(): void
    {
        if (empty($_SESSION['user_id'])) {
            // Si la petición es a la API, respondemos JSON; si es al portal, redirigimos.
            if (str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/api/')) {
                http_response_code(401);
                header('Content-Type: application/json');
                echo json_encode(['error' => 'No autenticado']);
                exit;
            }
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
    }
}
