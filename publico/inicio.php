<?php
/**
 * Punto de entrada del sitio público.
 *   inicio.php                -> portada
 *   inicio.php?pagina=menu    -> menú, etc. (ver rutas/rutas.php)
 */

require_once __DIR__ . '/../aplicacion/configuracion/conexion.php';
require_once __DIR__ . '/../aplicacion/funciones/funciones.php';
require_once __DIR__ . '/../aplicacion/modelos/ModeloProductos.php';
require_once __DIR__ . '/../aplicacion/controladores/ControladorProductos.php';
require_once __DIR__ . '/../rutas/rutas.php';

$claveSolicitada = isset($_GET['pagina']) && is_string($_GET['pagina']) ? $_GET['pagina'] : null;
$pagina          = resolverPagina($claveSolicitada);
$paginaActual    = $pagina['clave'];
$vista           = rutaVista($pagina['vista']);

$tituloPagina = $paginaActual === 'inicio'
    ? NOMBRE_NEGOCIO . ' | Tulancingo, Hidalgo'
    : $pagina['titulo'] . ' | ' . NOMBRE_NEGOCIO;

// Datos que necesita cada página (la vista solo los muestra)
$datos = [];
if ($paginaActual === 'inicio') {
    $datos = (new ControladorProductos(obtenerConexion()))->datosInicio();
}

require RUTA_RAIZ . '/vistas/componentes/encabezado.php';
require $vista ?? RUTA_RAIZ . '/vistas/paginas/en_construccion.php';
require RUTA_RAIZ . '/vistas/componentes/pie_pagina.php';
