<?php

/**
 * Funciones de apoyo reutilizables.
 */

/** Escapa texto para imprimirlo de forma segura en HTML (evita XSS). */
function e(?string $texto): string
{
    return htmlspecialchars($texto ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Da formato de precio: 40 -> $40.00 */
function formatoPrecio($precio): string
{
    return '$' . number_format((float) $precio, 2);
}


function redirigir(string $url): void
{
    header('Location: ' . $url);
    exit;
}


function enlaceWhatsapp(string $mensaje = ''): string
{
    $url = 'https://wa.me/' . WHATSAPP_NUMERO;
    return $mensaje !== '' ? $url . '?text=' . rawurlencode($mensaje) : $url;
}

function urlPagina(string $pagina = 'inicio'): string
{
    return $pagina === 'inicio' ? 'inicio.php' : 'inicio.php?pagina=' . rawurlencode($pagina);
}


function archivoPublicoExiste(string $rutaRelativa): bool
{
    $archivo = RUTA_RAIZ . '/publico/' . ltrim($rutaRelativa, '/');
    return is_file($archivo) && filesize($archivo) > 0;
}


function imagenProducto(?string $archivo): ?string
{
    if (!$archivo) {
        return null;
    }
    $ruta = 'recursos/imagenes/productos/' . basename($archivo);
    return archivoPublicoExiste($ruta) ? $ruta : null;
}

function formatoHora12(string $hora): string
{
    [$h, $m] = array_map('intval', explode(':', $hora));
    $sufijo = $h >= 12 ? 'PM' : 'AM';
    $h12 = $h % 12 ?: 12;
    return sprintf('%d:%02d %s', $h12, $m, $sufijo);
}
