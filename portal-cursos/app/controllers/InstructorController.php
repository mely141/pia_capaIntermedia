<?php
// app/controllers/InstructorController.php
// Pantallas del rol "instructor": dashboard, gestión de cursos, ventas (2 vistas).

class InstructorController extends Controller
{
    public function dashboard(): void
    {
        $this->view('instructor/dashboard');
    }

    public function misCursos(): void
    {
        // TODO (2da entrega): listar cursos reales vía CursoModel
        $cursos = [];
        $this->view('instructor/mis_cursos', compact('cursos'));
    }

    public function nuevoCurso(): void
    {
        $this->view('instructor/curso_form');
    }

    public function ventasResumen(): void
    {
        // Vista 1: lista por curso con alumnos, nivel promedio, ingresos
        $filtros = [
            'desde'     => $this->input('desde'),
            'hasta'     => $this->input('hasta'),
            'categoria' => $this->input('categoria', 'todas'),
            'activos'   => $this->input('activos', 'todos'),
        ];
        $reporte = [];
        $this->view('instructor/ventas_resumen', compact('filtros', 'reporte'));
    }

    public function ventasDetalle(array $params): void
    {
        // Vista 2: detalle por alumno dentro de un curso
        $cursoId = $params['id'] ?? null;
        $detalle = [];
        $this->view('instructor/ventas_detalle', compact('cursoId', 'detalle'));
    }
}
