<?php

//notaaaaaaa si quieren agregar productos deben de hacerlo desde la bd 
$productos   = $datos['productos'] ?? [];
$total       = count($productos);
$disponibles = count(array_filter($productos, fn($p) => (int) $p['disponible'] === 1));
$logo        = archivoPublicoExiste('recursos/imagenes/logo.png') ? 'recursos/imagenes/logo.png' : null;
$horario     = HORARIOS[0] ?? null;
$msgGeneral  = 'Hola, quiero hacer un pedido del menú 🍟';
?>


<section class="menu-banner">
    <div class="contenedor menu-banner__interior">

        <div class="menu-logo">
            <?php if ($logo): ?>
                <img class="menu-logo__img" src="<?= e($logo) ?>" alt="Logotipo de <?= e(NOMBRE_NEGOCIO) ?>">
            <?php elseif (APP_ENTORNO === 'desarrollo'): ?>

                <div class="menu-logo__hueco">
                    <span class="material-symbols-outlined" aria-hidden="true">add_photo_alternate</span>
                    <span>Tu logo aquí</span>
                    <small>imagenes/logotipo.png</small>
                </div>
            <?php else: ?>
                <div class="menu-logo__hueco menu-logo__hueco--texto"><span>🍟</span></div>
            <?php endif; ?>

            <div class="menu-logo__info">
                <span class="menu-logo__sello">Puesto tradicional</span>
                <span class="menu-logo__ciudad">Tulancingo, Hgo.</span>
                <span class="menu-logo__lugar">Colonia La Floresta</span>
            </div>
        </div>

        <div class="menu-banner__titulo">
            <span class="menu-banner__chip">
                <span class="material-symbols-outlined" aria-hidden="true">restaurant_menu</span>
                Carta botanera · precios al día
            </span>
            <h1>El menú</h1>
            <p>Recién salidas de la freidora.</p>
        </div>

    </div>
</section>

<div class="menu-cinta" aria-hidden="true">
    <div class="menu-cinta__pista">
        <?php for ($i = 0; $i < 2; $i++): ?>
            <span>🔥 Freidora en vivo</span><span>📦 Pedidos listos para recoger</span><span>🍟 Papas recién salidas</span>
        <?php endfor; ?>
    </div>
</div>

<section class="menu-contenido">
    <div class="contenedor menu-contenido__interior">

        <?php if ($total > 0): ?>
            <div class="menu-filtros" id="menu-filtros" role="group" aria-label="Filtrar productos">
                <div class="menu-filtros__botones">
                    <button type="button" class="menu-filtro activo" data-filtro="todos" aria-pressed="true">Todo el menú (<?= (int) $total ?>)</button>
                    <button type="button" class="menu-filtro" data-filtro="disponibles" aria-pressed="false">Disponibles (<?= (int) $disponibles ?>)</button>
                </div>
                <span class="menu-filtros__nota">
                    <span class="material-symbols-outlined" aria-hidden="true">schedule</span>
                    Pide antes, recoge caliente
                </span>
            </div>
        <?php endif; ?>

        <?php if ($total === 0): ?>
            <p class="vacio">Estamos actualizando el menú. Mientras tanto, pídenos por WhatsApp.</p>
        <?php endif; ?>

        <div class="menu-rejilla">
            <?php foreach ($productos as $i => $p):
                $disponible = (int) $p['disponible'] === 1;
                $foto       = imagenProducto($p['imagen']);
                $descripcion = trim((string) $p['descripcion']);
                $mensaje    = 'Hola, quiero pedir: ' . $p['nombre'] . ' (' . formatoPrecio($p['precio']) . ') 🍟';
            ?>
                <article class="menu-card revelar<?= $disponible ? '' : ' menu-card--agotado' ?>"
                    data-disponible="<?= $disponible ? '1' : '0' ?>"
                    style="--retraso: <?= (int) (($i % 3) * 90) ?>ms">

                    <header class="menu-card__cabecera">
                        <span class="menu-card__num">Comanda #<?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                        <span class="menu-card__estado<?= $disponible ? '' : ' menu-card__estado--agotado' ?>">
                            <?= $disponible ? 'Disponible' : 'Agotado' ?>
                        </span>
                    </header>

                    <div class="menu-card__foto">
                        <?php if ($foto): ?>
                            <img src="<?= e($foto) ?>" alt="<?= e($p['nombre']) ?>" loading="lazy">
                        <?php else: ?>
                            <div class="foto-vacia" aria-hidden="true">🍟</div>
                        <?php endif; ?>
                        <?php if (!$disponible): ?>
                            <div class="sello"><span>Agotado por hoy</span></div>
                        <?php endif; ?>
                    </div>

                    <div class="menu-card__cuerpo">
                        <div class="menu-card__titulo">
                            <h2><?= e($p['nombre']) ?></h2>
                            <span class="menu-card__precio"><?= e(formatoPrecio($p['precio'])) ?> <small>MXN</small></span>
                        </div>
                        <?php if ($descripcion !== ''): ?>
                            <p class="menu-card__desc"><?= e($descripcion) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="menu-card__accion">
                        <?php if ($disponible): ?>
                            <a class="boton boton--whatsapp boton--ancho" href="<?= e(enlaceWhatsapp($mensaje)) ?>" target="_blank" rel="noopener">
                                <span class="material-symbols-outlined" aria-hidden="true">chat</span>
                                <span>Pedir por WhatsApp</span>
                            </a>
                        <?php else: ?>
                            <span class="boton boton--apagado boton--ancho">No disponible por ahora</span>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>

            <!-- Tarjeta informativa -->
            <article class="menu-promo revelar">
                <div class="menu-promo__texto">
                    <span class="menu-promo__sello">Pedidos grandes</span>
                    <h2>Pedidos y reuniones</h2>
                    <p>¿Tienes una reunión, un evento o un antojo en grande? Escríbenos y armamos tu pedido surtido para que lo recojas.</p>
                    <?php if ($horario): ?>
                        <div class="menu-promo__horario">
                            <strong><span class="material-symbols-outlined" aria-hidden="true">schedule</span> Horario habitual</strong>
                            <span><?= e($horario['etiqueta']) ?>: <?= e(formatoHora12($horario['abre'])) ?> a <?= e(formatoHora12($horario['cierra'])) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <a class="boton boton--negro boton--ancho" href="<?= e(enlaceWhatsapp('Hola, quiero cotizar un pedido grande para un evento 🍟')) ?>" target="_blank" rel="noopener">
                    <span class="material-symbols-outlined" aria-hidden="true">celebration</span>
                    <span>Cotizar por mensaje</span>
                </a>
            </article>
        </div>

        <p class="vacio" id="menu-sin-resultados" hidden>Ahorita no hay productos disponibles. ¡Vuelve en un rato!</p>


        <section class="menu-pedido revelar">
            <div class="menu-pedido__texto">
                <p class="menu-pedido__marca">
                    <span class="material-symbols-outlined" aria-hidden="true">storefront</span> Puesto tradicional en La Floresta
                </p>
                <h2>Envía tu pedido completo</h2>
                <p>Mándanos por WhatsApp lo que se te antoje del menú y dinos a qué hora pasas. Te lo tenemos listo al llegar.</p>
                <ul class="menu-pedido__chips">
                    <li>✔ Papas recién salidas</li>
                    <li>✔ Sabor tradicional</li>
                    <li>✔ Pide antes, recoge caliente</li>
                </ul>
            </div>

            <div class="menu-pedido__caja">
                <span class="menu-pedido__etiqueta">Pedidos anticipados</span>
                <p class="menu-pedido__titulo">Pide por WhatsApp</p>
                <p>Envía tu lista y la hora en que pasas por ella.</p>
                <a class="boton boton--whatsapp boton--ancho" href="<?= e(enlaceWhatsapp($msgGeneral)) ?>" target="_blank" rel="noopener">
                    <span class="material-symbols-outlined" aria-hidden="true">chat</span>
                    <span>Enviar pedido completo</span>
                </a>
                <a class="menu-pedido__alterno" href="<?= e(urlPagina('contacto')) ?>">Prefiero llenar el formulario</a>
            </div>
        </section>

        <div class="menu-sellos">
            <div class="menu-sello revelar">
                <span class="menu-sello__icono menu-sello__icono--amarillo"><span class="material-symbols-outlined" aria-hidden="true">skillet</span></span>
                <div>
                    <h3>Hechas al momento</h3>
                    <p>Tu pedido sale de la freidora cuando llegas.</p>
                </div>
            </div>
            <div class="menu-sello revelar" style="--retraso: 90ms">
                <span class="menu-sello__icono menu-sello__icono--naranja"><span class="material-symbols-outlined" aria-hidden="true">local_fire_department</span></span>
                <div>
                    <h3>Salsas de la casa</h3>
                    <p>Elige las que más te gusten para acompañar.</p>
                </div>
            </div>
            <div class="menu-sello revelar" style="--retraso: 180ms">
                <span class="menu-sello__icono menu-sello__icono--rojo"><span class="material-symbols-outlined" aria-hidden="true">location_on</span></span>
                <div>
                    <h3>En La Floresta</h3>
                    <p>Tradición de barrio en Tulancingo, Hidalgo.</p>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
    (function() {
        var barra = document.getElementById('menu-filtros');
        if (!barra) {
            return;
        }
        var tarjetas = document.querySelectorAll('.menu-card');
        var aviso = document.getElementById('menu-sin-resultados');

        barra.addEventListener('click', function(ev) {
            var boton = ev.target.closest('.menu-filtro');
            if (!boton) {
                return;
            }
            var filtro = boton.getAttribute('data-filtro');

            barra.querySelectorAll('.menu-filtro').forEach(function(b) {
                var activo = (b === boton);
                b.classList.toggle('activo', activo);
                b.setAttribute('aria-pressed', activo ? 'true' : 'false');
            });

            var visibles = 0;
            tarjetas.forEach(function(t) {
                var mostrar = filtro === 'todos' || t.getAttribute('data-disponible') === '1';
                t.hidden = !mostrar;
                if (mostrar) {
                    visibles++;
                    t.classList.add('visible');
                }
            });
            if (aviso) {
                aviso.hidden = visibles !== 0;
            }
        });
    })();
</script>