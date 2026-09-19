<?php
// config/config.php
// Configuración global del proyecto. NO subir credenciales reales al repo (usar .env en producción).

define('APP_NAME', 'Portal de Cursos');
define('BASE_URL', '/'); // Ajustar si el proyecto corre dentro de una subcarpeta

// --- Base de datos ---
define('DB_HOST', 'localhost');
define('DB_NAME', 'portal_cursos');
define('DB_USER', 'root');
define('DB_PASS', ''); // TODO: mover a variable de entorno antes de la entrega final

// --- Sesión ---
define('SESSION_NAME', 'portal_cursos_sid');

// --- Intentos fallidos de login ---
define('MAX_LOGIN_ATTEMPTS', 3);

session_name(SESSION_NAME);
session_start();

// Autoload simple de clases (core, controllers, models)
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/../app/core/' . $class . '.php',
        __DIR__ . '/../app/controllers/' . $class . '.php',
        __DIR__ . '/../app/models/' . $class . '.php',
    ];
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});
