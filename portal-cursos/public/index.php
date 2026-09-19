<?php
// public/index.php
// Front Controller: única puerta de entrada de la aplicación.
// Todas las peticiones (portal y API) pasan por aquí y se enrutan.

require_once __DIR__ . '/../config/config.php';

$router = new Router();

// ---------- PÚBLICO (sin login) ----------
$router->get('/', function ($p) { (new PublicController())->home($p); });
$router->get('/buscador', function ($p) { (new PublicController())->buscador($p); });
$router->get('/curso/{id}', function ($p) { (new PublicController())->detalleCurso($p); });

// ---------- AUTENTICACIÓN ----------
$router->get('/login', function ($p) { (new AuthController())->mostrarLogin(); });
$router->post('/login', function ($p) { (new AuthController())->procesarLogin(); });
$router->get('/registro', function ($p) { (new AuthController())->mostrarRegistro(); });
$router->post('/registro', function ($p) { (new AuthController())->procesarRegistro(); });
$router->get('/logout', function ($p) { (new AuthController())->logout(); });

// ---------- ESTUDIANTE (requiere sesión + rol) ----------
$router->get('/estudiante/dashboard', function ($p) { (new EstudianteController())->dashboard(); }, [AuthMiddleware::class]);
$router->get('/estudiante/kardex', function ($p) { (new EstudianteController())->kardex(); }, [AuthMiddleware::class]);
$router->get('/estudiante/mensajes', function ($p) { (new EstudianteController())->mensajes(); }, [AuthMiddleware::class]);

// ---------- INSTRUCTOR (requiere sesión + rol) ----------
$router->get('/instructor/dashboard', function ($p) { (new InstructorController())->dashboard(); }, [AuthMiddleware::class]);
$router->get('/instructor/cursos', function ($p) { (new InstructorController())->misCursos(); }, [AuthMiddleware::class]);
$router->get('/instructor/cursos/nuevo', function ($p) { (new InstructorController())->nuevoCurso(); }, [AuthMiddleware::class]);
$router->get('/instructor/ventas', function ($p) { (new InstructorController())->ventasResumen(); }, [AuthMiddleware::class]);
$router->get('/instructor/ventas/{id}', function ($p) { (new InstructorController())->ventasDetalle($p); }, [AuthMiddleware::class]);

// ---------- ADMINISTRADOR (requiere sesión + rol) ----------
$router->get('/admin/dashboard', function ($p) { (new AdminController())->dashboard(); }, [AuthMiddleware::class]);
$router->get('/admin/categorias', function ($p) { (new AdminController())->categorias(); }, [AuthMiddleware::class]);
$router->get('/admin/usuarios', function ($p) { (new AdminController())->usuarios(); }, [AuthMiddleware::class]);
$router->get('/admin/reportes/usuarios', function ($p) { (new AdminController())->reporteUsuarios(); }, [AuthMiddleware::class]);

// ---------- API PROPIA ----------
// Orden de middlewares en rutas /api/*: CORS primero (resuelve preflight OPTIONS),
// luego AuthMiddleware si el endpoint requiere sesión.
// Estos dos endpoints de "cursos" son públicos de lectura, por eso solo llevan CORS.
$router->get('/api/cursos', function ($p) { (new ApiCursosController())->listar($p); }, [CorsMiddleware::class]);
$router->get('/api/cursos/{id}', function ($p) { (new ApiCursosController())->obtener($p); }, [CorsMiddleware::class]);

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
