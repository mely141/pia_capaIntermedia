<?php
// app/controllers/AdminController.php
// Pantallas del rol "administrador": categorías, usuarios (bloqueo/desbloqueo),
// comentarios reportados, reporte de usuarios.

class AdminController extends Controller
{
    public function dashboard(): void
    {
        $this->view('admin/dashboard');
    }

    public function categorias(): void
    {
        $categorias = [];
        $this->view('admin/categorias', compact('categorias'));
    }

    public function usuarios(): void
    {
        $usuarios = [];
        $this->view('admin/usuarios', compact('usuarios'));
    }

    public function reporteUsuarios(): void
    {
        $tipo = $this->input('tipo', 'instructor'); // instructor | estudiante
        $reporte = [];
        $this->view('admin/reporte_usuarios', compact('tipo', 'reporte'));
    }
}
