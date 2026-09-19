-- schema.sql
-- Portal de Cursos — script de creación de base de datos
-- No se evalúa normalización ni diccionario de datos en esta UA.

CREATE DATABASE IF NOT EXISTS portal_cursos CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE portal_cursos;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(150) NOT NULL,
    genero CHAR(1) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    rol ENUM('instructor','estudiante','administrador') NOT NULL,
    avatar VARCHAR(255) NULL,
    intentos_fallidos TINYINT NOT NULL DEFAULT 0,
    activo TINYINT NOT NULL DEFAULT 1,
    fecha_registro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_ultimo_cambio DATETIME NULL
);

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NULL,
    creado_por INT NOT NULL,
    fecha_creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_categorias_usuario FOREIGN KEY (creado_por) REFERENCES usuarios(id)
);

CREATE TABLE cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    instructor_id INT NOT NULL,
    categoria_id INT NOT NULL,
    titulo VARCHAR(150) NOT NULL,
    descripcion TEXT NULL,
    imagen VARCHAR(255) NULL,
    costo DECIMAL(10,2) NOT NULL DEFAULT 0,
    gratis TINYINT NOT NULL DEFAULT 0,
    activo TINYINT NOT NULL DEFAULT 1,
    fecha_publicacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_cursos_instructor FOREIGN KEY (instructor_id) REFERENCES usuarios(id),
    CONSTRAINT fk_cursos_categoria FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

CREATE TABLE curso_niveles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    curso_id INT NOT NULL,
    numero_nivel INT NOT NULL,
    titulo VARCHAR(150) NOT NULL,
    video_url VARCHAR(255) NOT NULL,
    costo_nivel DECIMAL(10,2) NULL,
    gratis TINYINT NOT NULL DEFAULT 0,
    CONSTRAINT fk_niveles_curso FOREIGN KEY (curso_id) REFERENCES cursos(id)
);

CREATE TABLE inscripciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    curso_id INT NOT NULL,
    estudiante_id INT NOT NULL,
    fecha_inscripcion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ultima_actividad DATETIME NULL,
    fecha_terminacion DATETIME NULL,
    nivel_actual INT NOT NULL DEFAULT 1,
    precio_pagado DECIMAL(10,2) NOT NULL DEFAULT 0,
    forma_pago VARCHAR(50) NULL,
    completo TINYINT NOT NULL DEFAULT 0,
    CONSTRAINT fk_inscripciones_curso FOREIGN KEY (curso_id) REFERENCES cursos(id),
    CONSTRAINT fk_inscripciones_estudiante FOREIGN KEY (estudiante_id) REFERENCES usuarios(id)
);

CREATE TABLE certificados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    inscripcion_id INT NOT NULL,
    fecha_terminacion DATE NOT NULL,
    certificado_por VARCHAR(150) NOT NULL,
    CONSTRAINT fk_certificados_inscripcion FOREIGN KEY (inscripcion_id) REFERENCES inscripciones(id)
);

CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    curso_id INT NOT NULL,
    usuario_id INT NOT NULL,
    texto TEXT NOT NULL,
    calificacion TINYINT NOT NULL,
    fecha_creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    eliminado TINYINT NOT NULL DEFAULT 0,
    fecha_eliminacion DATETIME NULL,
    causa_eliminacion VARCHAR(255) NULL,
    CONSTRAINT fk_comentarios_curso FOREIGN KEY (curso_id) REFERENCES cursos(id),
    CONSTRAINT fk_comentarios_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE mensajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    curso_id INT NOT NULL,
    emisor_id INT NOT NULL,
    receptor_id INT NOT NULL,
    texto TEXT NOT NULL,
    fecha_envio DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_mensajes_curso FOREIGN KEY (curso_id) REFERENCES cursos(id),
    CONSTRAINT fk_mensajes_emisor FOREIGN KEY (emisor_id) REFERENCES usuarios(id),
    CONSTRAINT fk_mensajes_receptor FOREIGN KEY (receptor_id) REFERENCES usuarios(id)
);
