<?php
// app/core/Controller.php
// Controlador base: solo orquesta (recibe petición, llama al modelo, elige vista).
// No debe contener SQL ni lógica de acceso a datos.

abstract class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);
        $viewPath = __DIR__ . '/../views/' . $view . '.php';
        if (!file_exists($viewPath)) {
            throw new RuntimeException("Vista no encontrada: $view");
        }
        require __DIR__ . '/../views/layout/header.php';
        require $viewPath;
        require __DIR__ . '/../views/layout/footer.php';
    }

    protected function redirect(string $path): void
    {
        header('Location: ' . BASE_URL . ltrim($path, '/'));
        exit;
    }

    protected function json($data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    protected function input(string $key, $default = null)
    {
        return $_POST[$key] ?? $_GET[$key] ?? $default;
    }
}
