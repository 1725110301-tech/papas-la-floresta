<?php
/**
 * Conexión a MySQL mediante PDO.
 * Uso:  $bd = obtenerConexion();
 */

require_once __DIR__ . '/ajustes.php';

function obtenerConexion(): PDO
{
    static $conexion = null;

    if ($conexion instanceof PDO) {
        return $conexion;
    }

    $dsn = sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
        BD_HOST,
        BD_PUERTO,
        BD_NOMBRE
    );

    try {
        $conexion = new PDO($dsn, BD_USUARIO, BD_PASSWORD, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false, // consultas preparadas reales
        ]);
    } catch (PDOException $e) {
        error_log('Error de conexión a la BD: ' . $e->getMessage());
        http_response_code(500);
        exit(APP_ENTORNO === 'desarrollo'
            ? 'Error de conexión: ' . $e->getMessage()
            : 'Servicio no disponible por el momento.');
    }

    return $conexion;
}
