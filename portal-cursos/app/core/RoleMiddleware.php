<?php
// app/core/RoleMiddleware.php
// Middleware OBLIGATORIO (parte 2 del control de acceso): valida el rol.
// Se instancia por ruta indicando qué rol(es) puede acceder.
// Nota: Router::dispatch instancia middlewares sin argumentos, por eso
// aquí se define una fábrica estática por rol (RoleMiddleware::admin(), etc.)
// que el Router puede usar como clase "anónima" ya configurada.
// Para mantener el ejemplo simple en este esqueleto, se deja como
// middleware genérico y el controlador valida el rol puntual con
// requireRole(). Cuando se implemente la lógica completa (2da entrega),
// se recomienda refactorizar a una clase por rol o a una configurable.

class RoleMiddleware
{
    public function handle(): void
    {
        // Placeholder: la validación fina de rol se resuelve en el controlador
        // con $this->requireRole('admin') una vez confirmada la sesión.
        if (empty($_SESSION['user_role'])) {
            http_response_code(403);
            echo 'Rol no definido en sesión.';
            exit;
        }
    }
}
