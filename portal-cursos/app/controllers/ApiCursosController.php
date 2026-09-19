<?php
// app/controllers/ApiCursosController.php
// API propia REST sobre el recurso "cursos" (categoría de recurso, no verbos en la ruta).
// GET  /api/cursos        -> listar (200)
// GET  /api/cursos/{id}   -> obtener uno (200 | 404)
// Debe poder probarse desde Postman sin usar las vistas del portal.

class ApiCursosController extends Controller
{
    public function listar(array $params = []): void
    {
        try {
            // TODO (2da entrega): reemplazar por CursoModel::listarActivos()
            $cursos = [
                ['id' => 1, 'titulo' => 'Introducción a PHP', 'categoria' => 'IT & Software'],
                ['id' => 2, 'titulo' => 'Marketing Digital 101', 'categoria' => 'Marketing'],
            ];
            $this->json(['data' => $cursos], 200);
        } catch (Throwable $e) {
            error_log($e->getMessage());
            $this->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    public function obtener(array $params): void
    {
        try {
            $id = (int) ($params['id'] ?? 0);
            if ($id <= 0) {
                $this->json(['error' => 'ID inválido'], 400);
            }

            // TODO (2da entrega): reemplazar por CursoModel::buscarPorId($id)
            $cursosMock = [
                1 => ['id' => 1, 'titulo' => 'Introducción a PHP', 'categoria' => 'IT & Software'],
                2 => ['id' => 2, 'titulo' => 'Marketing Digital 101', 'categoria' => 'Marketing'],
            ];

            if (!isset($cursosMock[$id])) {
                $this->json(['error' => 'Curso no encontrado'], 404);
            }

            $this->json(['data' => $cursosMock[$id]], 200);
        } catch (Throwable $e) {
            error_log($e->getMessage());
            $this->json(['error' => 'Error interno del servidor'], 500);
        }
    }
}
