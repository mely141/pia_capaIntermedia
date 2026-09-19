# Portal de Cursos — Primera Entrega (PHP puro + MVC)

## Requisitos
- PHP 8.x
- MySQL (opcional para esta entrega; el flujo de login usa la tabla `usuarios`)

## Cómo correrlo

1. Crear la base de datos (opcional en esta entrega, necesaria si pruebas login/registro):
   ```bash
   mysql -u root -p < docs/schema.sql
   ```
2. Revisar credenciales de BD en `config/config.php`.
3. Levantar el servidor embebido de PHP desde la raíz del proyecto:
   ```bash
   php -S localhost:8000 -t public
   ```
4. Abrir `http://localhost:8000` en el navegador.

## Qué incluye esta entrega
- Estructura MVC completa en PHP puro (sin frameworks de PHP).
- Front Controller (`public/index.php`) + Router propio.
- Navegación funcional entre las 5 pantallas requeridas: pública, autenticación,
  estudiante, instructor y administrador.
- Middleware obligatorio de control de acceso (`AuthMiddleware`) y CORS (`CorsMiddleware`).
- API propia con 2 endpoints funcionales (`GET /api/cursos`, `GET /api/cursos/{id}`),
  responde JSON con códigos de estado correctos, probable desde Postman.
- Validaciones de formulario en JavaScript (campos obligatorios, email, reglas de contraseña).
- Documentación en `docs/`: contrato de API, arquitectura de 3 capas, propuesta
  de API de terceros, estructura de tablas + script SQL.

## Qué queda pendiente para la 2da/3ra entrega
- Conexión real de todos los modelos a MySQL (hoy hay datos mock en varios controladores).
- Lógica de negocio completa: inscripciones, kardex, ventas, certificados, comentarios, mensajes.
- Integración real de la API de terceros (pendiente visto bueno del profesor).
- Validación de contraseña y demás reglas también en el servidor (hoy solo en cliente).
