<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($tituloPagina ?? NOMBRE_NEGOCIO) ?></title>
    <meta name="description" content="Papas a la francesa, plátanos fritos, banderillas y nachos en La Floresta, Tulancingo, Hidalgo. Haz tu pedido por WhatsApp.">
    <meta name="theme-color" content="#111111">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=DM+Sans:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=block">

    <link rel="stylesheet" href="recursos/estilos/principal.css">
    <link rel="stylesheet" href="recursos/estilos/adaptable.css">
    <link rel="stylesheet" href="recursos/estilos/paginas.css">

    <script>
        document.documentElement.classList.add('js');
    </script>
</head>

<body class="pagina-<?= e($paginaActual) ?>">
    <a class="saltar" href="#contenido">Saltar al contenido</a>

    <header class="encabezado">
        <div class="contenedor encabezado__interior">
            <a class="logo" href="<?= e(urlPagina('inicio')) ?>" aria-label="<?= e(NOMBRE_NEGOCIO) ?> - Inicio">
                <span class="logo__nombre">La Floresta</span>
                <span class="logo__lema">Papas a la Francesa • Tulancingo, Hgo.</span>
            </a>

            <?php require __DIR__ . '/navegacion.php'; ?>

            <a class="boton boton--rojo boton--chico" href="<?= e(enlaceWhatsapp('Hola, quiero hacer un pedido 🍟')) ?>" target="_blank" rel="noopener">
                <span class="material-symbols-outlined" aria-hidden="true">chat</span>
                <span class="solo-movil">Pedir</span>
                <span class="solo-escritorio">Pedir por WhatsApp</span>
            </a>
        </div>
    </header>

    <main id="contenido">