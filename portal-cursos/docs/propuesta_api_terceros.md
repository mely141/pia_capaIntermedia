# Propuesta de API de Terceros

> Requiere visto bueno del profesor antes de integrarse (según lo indicado en
> la Forma de Evaluación).

## Servicio propuesto: Cloudinary (almacenamiento y transmisión de imágenes/video)

- **Necesidad del portal que resuelve:** almacenamiento de las imágenes de
  avatar de usuario, imágenes de portada de cada curso, y los videos de
  contenido de cada nivel, sin depender del almacenamiento local del servidor.
- **Documentación oficial:** https://cloudinary.com/documentation
- **Datos que se consumirán/enviarán:**
  - Envío: archivo de imagen/video (avatar, portada de curso, video de nivel).
  - Recepción: URL segura (`secure_url`) del recurso subido, para guardarla en
    la base de datos y mostrarla en las vistas.
- **Dónde se consumirá:** a definir por el equipo (controlador en servidor vía
  su SDK/REST API, o desde la vista con su widget de subida); se documentará
  la decisión final una vez aprobada la propuesta.
- **Manejo de credenciales:** API Key/Secret se guardarán en variables de
  entorno (`.env`, fuera del repositorio) y se leerán mediante configuración,
  nunca hardcodeadas en el código versionado.

### Alternativa de respaldo (por si no se aprueba Cloudinary)
- **Servicio:** SendGrid (envío de correo) — para notificar al estudiante
  cuando se genera su certificado/diploma, o al instructor cuando recibe un
  mensaje nuevo.
- **Documentación oficial:** https://docs.sendgrid.com/

*(El equipo integrará el servicio que reciba el visto bueno del profesor;
ambas opciones cubren una necesidad real y distinta del portal.)*
