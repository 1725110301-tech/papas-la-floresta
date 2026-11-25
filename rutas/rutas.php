<?php
/**
 * Rutas públicas. Se entra siempre por publico/inicio.php?pagina=<clave>
 * Para agregar una página nueva: crea su vista en vistas/paginas/ y añádela aquí.
 */

function rutasPublicas(): array
{
    return [
        'inicio'    => ['titulo' => 'Inicio',               'vista' => 'inicio.php'],
        'menu'      => ['titulo' => 'Menú',                 'vista' => 'menu.php'],
        'nosotros'  => ['titulo' => 'Nosotros',             'vista' => 'nosotros.php'],
        'ubicacion' => ['titulo' => 'Ubicación y horarios', 'vista' => 'ubicacion.php'],
        'contacto'  => ['titulo' => 'Contacto y pedidos',   'vista' => 'contacto.php'],
    ];
}
function resolverPagina(?string $clave): array
{
    $rutas = rutasPublicas();
    $clave = $clave ?? 'inicio';

    if (!isset($rutas[$clave])) {
        http_response_code(404);
        return ['clave' => '404', 'titulo' => 'Página no encontrada', 'vista' => null];
    }
    return ['clave' => $clave] + $rutas[$clave];
}

function rutaVista(?string $archivo): ?string
{
    if ($archivo === null) {
        return null;
    }
    $ruta = RUTA_RAIZ . '/vistas/paginas/' . $archivo;
    return (is_file($ruta) && filesize($ruta) > 0) ? $ruta : null;
}
