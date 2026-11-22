-- ============================================================
-- Papas a la Francesa La Floresta - Estructura de la base de datos
-- Importar en phpMyAdmin (http://localhost/phpmyadmin) > pestaña "Importar"
-- ============================================================

CREATE DATABASE IF NOT EXISTS papas_floresta
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE papas_floresta;

-- Tabla 1: productos
CREATE TABLE IF NOT EXISTS productos (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    nombre         VARCHAR(150)   NOT NULL,
    descripcion    TEXT           NULL,
    precio         DECIMAL(10,2)  NOT NULL DEFAULT 0.00,
    imagen         VARCHAR(255)   NULL,
    disponible     TINYINT(1)     NOT NULL DEFAULT 1,
    fecha_creacion TIMESTAMP      NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabla 2: pedidos_web
CREATE TABLE IF NOT EXISTS pedidos_web (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    nombre_cliente VARCHAR(150)   NOT NULL,
    telefono       VARCHAR(20)    NOT NULL,
    pedido_detalle TEXT           NOT NULL,
    comentarios    TEXT           NULL,
    fecha          TIMESTAMP      NOT NULL DEFAULT CURRENT_TIMESTAMP,
    estado         VARCHAR(30)    NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB;

-- Tabla 3: administradores
CREATE TABLE IF NOT EXISTS administradores (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    usuario        VARCHAR(50)    NOT NULL UNIQUE,
    password       VARCHAR(255)   NOT NULL,
    fecha_creacion TIMESTAMP      NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
