<?php

/**
 * Ajustes generales del proyecto.
 * Carga las variables del archivo .env (o del entorno del servidor, como en Render)
 * y define las constantes que usa el resto de la aplicación.
 */

define('RUTA_RAIZ', dirname(__DIR__, 2));

/**
 * Lee el archivo .env (formato CLAVE=valor) y lo pone en $_ENV.
 */
function cargarEntorno(string $archivo): void
{
    if (!is_file($archivo)) {
        return;
    }
    foreach (file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $linea) {
        $linea = trim($linea);
        if ($linea === '' || $linea[0] === '#' || strpos($linea, '=') === false) {
            continue;
        }
        [$clave, $valor] = explode('=', $linea, 2);
        $_ENV[trim($clave)] = trim($valor, " \t\"'");
    }
}

function entorno(string $clave, $porDefecto = null)
{
    if (isset($_ENV[$clave])) {
        return $_ENV[$clave];
    }
    $valor = getenv($clave);
    return $valor !== false ? $valor : $porDefecto;
}

cargarEntorno(RUTA_RAIZ . '/.env');

// Base de datos
define('BD_HOST',     entorno('BD_HOST', 'localhost'));
define('BD_PUERTO',   entorno('BD_PUERTO', '3306'));
define('BD_NOMBRE',   entorno('BD_NOMBRE', 'papas_floresta'));
define('BD_USUARIO',  entorno('BD_USUARIO', 'root'));
define('BD_PASSWORD', entorno('BD_PASSWORD', ''));

// Negocio
define('NOMBRE_NEGOCIO',   'Papas a la Francesa La Floresta');
define('WHATSAPP_NUMERO',  entorno('WHATSAPP_NUMERO', ''));

// Entorno
define('APP_ENTORNO', entorno('APP_ENTORNO', 'desarrollo'));

if (APP_ENTORNO === 'desarrollo') {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    error_reporting(E_ALL & ~E_DEPRECATED);
}

date_default_timezone_set('America/Mexico_City');

// ------------------------------------------------------------
// Datos del negocio (se muestran en el sitio público)
// ------------------------------------------------------------
define('DIRECCION',     entorno('DIRECCION', 'La Floresta, Tulancingo de Bravo, Hidalgo'));
define('FACEBOOK_URL',  entorno('FACEBOOK_URL', ''));
define('INSTAGRAM_URL', entorno('INSTAGRAM_URL', ''));

/**
 * Horarios del puesto. ¡EDÍTALOS con los reales!
 * dias: 0 = domingo, 1 = lunes ... 6 = sábado. Horas en formato 24 h.
 * Si "cierra" es menor que "abre", se entiende que cierra después de medianoche.
 * Este arreglo alimenta el pie de página y el letrero "Abierto ahora".
 */
const HORARIOS = [
    ['etiqueta' => 'Lunes a Domingo', 'dias' => [0, 1, 2, 3, 4, 5, 6], 'abre' => '17:00', 'cierra' => '23:30'],
];
