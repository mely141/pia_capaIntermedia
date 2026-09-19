<?php
// app/controllers/AuthController.php
// Registro, login (con bloqueo a 3 intentos fallidos) y logout.
// Las reglas de contraseña (8+ caracteres, mayúscula, número, carácter
// especial) se validan en el cliente (JS) Y deben revalidarse en servidor
// en la 2da entrega, cuando esté la lógica de negocio completa.

class AuthController extends Controller
{
    public function mostrarLogin(): void
    {
        $this->view('auth/login');
    }

    public function procesarLogin(): void
    {
        $email = trim($this->input('email', ''));
        $password = $this->input('password', '');

        if ($email === '' || $password === '') {
            $this->redirect('login?error=campos_requeridos');
        }

        $db = Database::getConnection();
        $usuarioModel = new UsuarioModel($db);
        $usuario = $usuarioModel->buscarPorEmail($email);

        if (!$usuario || !$usuario['activo']) {
            $this->redirect('login?error=credenciales_invalidas');
        }

        if (!password_verify($password, $usuario['password_hash'])) {
            $usuarioModel->incrementarIntentosFallidos((int) $usuario['id']);
            if (($usuario['intentos_fallidos'] + 1) >= MAX_LOGIN_ATTEMPTS) {
                $usuarioModel->deshabilitar((int) $usuario['id']);
                $this->redirect('login?error=cuenta_bloqueada');
            }
            $this->redirect('login?error=credenciales_invalidas');
        }

        $usuarioModel->resetearIntentosFallidos((int) $usuario['id']);

        $_SESSION['user_id']   = $usuario['id'];
        $_SESSION['user_role'] = $usuario['rol'];
        $_SESSION['user_name'] = $usuario['nombre_completo'];

        $this->redirect($usuario['rol'] === 'instructor' ? 'instructor/dashboard' : 'estudiante/dashboard');
    }

    public function mostrarRegistro(): void
    {
        $this->view('auth/registro');
    }

    public function procesarRegistro(): void
    {
        // TODO (2da entrega): validación completa en servidor + guardado de avatar
        $this->redirect('login?ok=registrado');
    }

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
        $this->redirect('login');
    }
}
