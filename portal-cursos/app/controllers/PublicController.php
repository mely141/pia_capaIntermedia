<?php
// app/controllers/PublicController.php
// Pantallas visibles sin sesión: home, buscador, detalle de curso (solo lectura).

class PublicController extends Controller
{
    public function home(array $params = []): void
    {
        // TODO (2da entrega): traer cursos reales desde CursoModel
        $cursosDestacados = [];
        $categorias = [];
        $this->view('public/home', compact('cursosDestacados', 'categorias'));
    }

    public function buscador(array $params = []): void
    {
        $q = $this->input('q', '');
        $categoria = $this->input('categoria', '');
        // TODO (2da entrega): ejecutar búsqueda real vía CursoModel
        $resultados = [];
        $this->view('public/buscador', compact('q', 'categoria', 'resultados'));
    }

    public function detalleCurso(array $params): void
    {
        $id = $params['id'] ?? null;
        // TODO (2da entrega): traer curso real; si no existe o está inactivo -> 404
        $curso = null;
        $this->view('public/detalle_curso', compact('id', 'curso'));
    }
}
