<section class="seccion">
    <div class="contenedor construccion">
        <p class="rotulo">Ya casi</p>
        <h1 class="seccion__titulo"><?= e($pagina['titulo']) ?></h1>
        <p class="seccion__texto">
            <?= $paginaActual === '404'
                ? 'No encontramos esta página. Regresa al inicio para ver el menú.'
                : 'Estamos preparando esta sección. Mientras tanto, mira nuestro menú o pide por WhatsApp.' ?>
        </p>
        <a class="boton boton--amarillo" href="<?= e(urlPagina('inicio')) ?>">Volver al inicio</a>
    </div>
</section>
