# Contrato de la API Propia — Portal de Cursos

Recurso expuesto en esta primera entrega: **cursos** (lectura). En entregas
posteriores se ampliará a usuarios, categorías, inscripciones, etc., pero el
mínimo de 2 endpoints funcionales ya está cubierto aquí.

Base URL: `http://localhost:8000/api`

---

## 1. GET /api/cursos

Lista los cursos activos (paginación y filtros se añaden en la 2da entrega).

**Método HTTP:** `GET`
**Ruta:** `/api/cursos`
**Autenticación:** No requerida (endpoint público de solo lectura)

### Parámetros de entrada
Ninguno en esta entrega.

### Respuesta exitosa — 200 OK
```json
{
  "data": [
    { "id": 1, "titulo": "Introducción a PHP", "categoria": "IT & Software" },
    { "id": 2, "titulo": "Marketing Digital 101", "categoria": "Marketing" }
  ]
}
```

### Respuesta de error — 500 Internal Server Error
```json
{ "error": "Error interno del servidor" }
```

---

## 2. GET /api/cursos/{id}

Obtiene el detalle de un curso por su identificador.

**Método HTTP:** `GET`
**Ruta:** `/api/cursos/{id}`
**Autenticación:** No requerida

### Parámetros de entrada
| Parámetro | Ubicación | Tipo | Obligatorio | Descripción |
|-----------|-----------|------|--------------|-------------|
| id        | ruta      | int  | Sí           | Identificador del curso |

### Respuesta exitosa — 200 OK
```json
{
  "data": { "id": 1, "titulo": "Introducción a PHP", "categoria": "IT & Software" }
}
```

### Respuesta de error — 400 Bad Request
```json
{ "error": "ID inválido" }
```

### Respuesta de error — 404 Not Found
```json
{ "error": "Curso no encontrado" }
```

### Respuesta de error — 500 Internal Server Error
```json
{ "error": "Error interno del servidor" }
```

---

## Convenciones generales del contrato

- Todas las respuestas son `Content-Type: application/json; charset=utf-8`.
- Los recursos se identifican por la **ruta**; la operación la determina el
  **método HTTP** (arquitectura REST). No se usan verbos en la URL.
- Códigos de estado usados en el proyecto: `200`, `201`, `400`, `401`, `404`, `500`.
- Los endpoints protegidos (a incorporar en la 2da entrega) requerirán sesión
  activa vía `AuthMiddleware` y devolverán `401` si no hay sesión válida.
- CORS está configurado de forma explícita en `CorsMiddleware` para permitir
  el consumo desde el cliente del portal.
