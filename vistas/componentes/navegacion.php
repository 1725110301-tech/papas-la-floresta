<?php
$enlaces = [
    'inicio'    => ['Inicio',    'home'],
    'menu'      => ['Menú',      'restaurant_menu'],
    'nosotros'  => ['Nosotros',  'storefront'],
    'ubicacion' => ['Ubicación', 'location_on'],
    'contacto'  => ['Contacto',  'chat'],
];
?>
<!-- Escritorio / tableta: enlaces en el encabezado -->
<nav class="nav-principal" aria-label="Navegación principal">
    <?php foreach ($enlaces as $clave => [$texto, $icono]): ?>
        <a href="<?= e(urlPagina($clave)) ?>"<?= $clave === $paginaActual ? ' class="activo" aria-current="page"' : '' ?>><?= e($texto) ?></a>
    <?php endforeach; ?>
</nav>

<!-- Teléfono: barra inferior -->
<nav class="nav-movil" aria-label="Navegación móvil">
    <?php foreach ($enlaces as $clave => [$texto, $icono]): ?>
        <a href="<?= e(urlPagina($clave)) ?>"<?= $clave === $paginaActual ? ' class="activo" aria-current="page"' : '' ?>>
            <span class="material-symbols-outlined" aria-hidden="true"><?= e($icono) ?></span>
            <span><?= e($texto) ?></span>
        </a>
    <?php endforeach; ?>
</nav>
