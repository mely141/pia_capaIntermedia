<?php
// app/models/UsuarioModel.php
// Capa de Modelo: única capa autorizada para tocar la base de datos.
// Recibe la conexión por inyección de dependencias (constructor) en vez
// de crearla internamente, para poder sustituirla (mock) en pruebas.

class UsuarioModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function buscarPorEmail(string $email): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM usuarios WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function crear(array $datos): int
    {
        $sql = 'INSERT INTO usuarios (nombre_completo, genero, fecha_nacimiento, email,
                    password_hash, rol, avatar, fecha_registro)
                VALUES (:nombre_completo, :genero, :fecha_nacimiento, :email,
                    :password_hash, :rol, :avatar, NOW())';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'nombre_completo'  => $datos['nombre_completo'],
            'genero'           => $datos['genero'],
            'fecha_nacimiento' => $datos['fecha_nacimiento'],
            'email'            => $datos['email'],
            'password_hash'    => password_hash($datos['password'], PASSWORD_DEFAULT),
            'rol'              => $datos['rol'], // 'instructor' | 'estudiante'
            'avatar'           => $datos['avatar'] ?? null,
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function incrementarIntentosFallidos(int $userId): void
    {
        $stmt = $this->db->prepare(
            'UPDATE usuarios SET intentos_fallidos = intentos_fallidos + 1 WHERE id = :id'
        );
        $stmt->execute(['id' => $userId]);
    }

    public function resetearIntentosFallidos(int $userId): void
    {
        $stmt = $this->db->prepare(
            'UPDATE usuarios SET intentos_fallidos = 0 WHERE id = :id'
        );
        $stmt->execute(['id' => $userId]);
    }

    public function deshabilitar(int $userId): void
    {
        $stmt = $this->db->prepare('UPDATE usuarios SET activo = 0 WHERE id = :id');
        $stmt->execute(['id' => $userId]);
    }
}
