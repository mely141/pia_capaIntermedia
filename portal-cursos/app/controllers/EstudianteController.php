<?php
// app/controllers/EstudianteController.php
// Pantallas del rol "estudiante": dashboard, kardex (con filtros), mensajes.

class EstudianteController extends Controller
{
    public function dashboard(): void
    {
        $this->view('student/dashboard');
    }

    public function kardex(): void
    {
        // Filtros esperados: rango de fechas, categoría, terminado/todos, activo/todos
        $filtros = [
            'desde'       => $this->input('desde'),
            'hasta'       => $this->input('hasta'),
            'categoria'   => $this->input('categoria', 'todas'),
            'terminados'  => $this->input('terminados', 'todos'),
            'activos'     => $this->input('activos', 'todos'),
        ];
        // TODO (3ra entrega): consultar KardexModel con estos filtros
        $registros = [];
        $this->view('student/kardex', compact('filtros', 'registros'));
    }

    public function mensajes(): void
    {
        $this->view('student/mensajes');
    }
}
