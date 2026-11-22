<?php
$destacados  = $datos['destacados']  ?? [];
$precioDesde = $datos['precioDesde'] ?? null;
$hayPortada  = archivoPublicoExiste('recursos/imagenes/portada.jpg');
?>

<!-- ===================== HERO ===================== -->
<section class="hero">
    <div class="contenedor hero__rejilla">

        <div class="hero__texto">
            <div class="hero__etiquetas">
                <div class="estado-abierto" id="estado-abierto" data-estado="desconocido">
                    <span class="estado-abierto__punto" aria-hidden="true"></span>
                    <span id="estado-abierto-texto">Consulta nuestro horario</span>
                </div>
                <p class="etiqueta">Puesto tradicional de botana</p>
            </div>

            <h1 class="hero__titulo">
                <span class="hero__linea hero__linea--amarilla">Papas a la francesa</span>
                <span class="hero__linea hero__linea--blanca">La Floresta</span>
            </h1>

            <p class="hero__eslogan">Crujientes desde siempre, directo de La Floresta. Doradas en aceite caliente, con sal, limón y las salsas de la casa.</p>

            <div class="hero__botones">
                <a class="boton boton--amarillo" href="<?= e(urlPagina('menu')) ?>">
                    <span>Ver el menú</span>
                    <span class="material-symbols-outlined" aria-hidden="true">restaurant_menu</span>
                </a>
                <a class="boton boton--rojo" href="<?= e(enlaceWhatsapp('Hola, quiero hacer un pedido 🍟')) ?>" target="_blank" rel="noopener">
                    <span class="material-symbols-outlined" aria-hidden="true">chat</span>
                    <span>Pedir por WhatsApp</span>
                </a>
            </div>

            <ul class="hero__chips">
                <li>Hechas al momento</li>
                <li>Salsas de la casa</li>
                <li>Sal, limón y chile al gusto</li>
            </ul>
        </div>

        <div class="hero__visual">
            <div class="marco">
                <div class="marco__cabecera">
                    <span>Orden recién hecha</span>
                    <span class="marco__chip">Hot ♨</span>
                </div>

                <div class="marco__imagen">
                    <?php if ($hayPortada): ?>
                        <img src="recursos/imagenes/portada.jpg" alt="Papas a la francesa doradas en cono de papel">
                    <?php else: ?>
                        <!-- Ilustración propia (se reemplaza sola cuando subas imagenes/portada.jpg) -->
                        <svg class="ilustracion" viewBox="0 0 400 440" role="img" aria-label="Cono de papel lleno de papas a la francesa doradas">
                            <g class="ilustracion__papas">
                                <rect x="86"  y="96" width="34" height="140" rx="7" transform="rotate(-24 103 236)"/>
                                <rect x="112" y="46" width="34" height="190" rx="7" transform="rotate(-14 129 236)"/>
                                <rect x="150" y="22" width="34" height="214" rx="7" transform="rotate(-6 167 236)"/>
                                <rect x="190" y="10" width="34" height="226" rx="7" transform="rotate(2 207 236)"/>
                                <rect x="230" y="30" width="34" height="206" rx="7" transform="rotate(10 247 236)"/>
                                <rect x="268" y="62" width="34" height="174" rx="7" transform="rotate(19 285 236)"/>
                                <rect x="296" y="110" width="30" height="126" rx="7" transform="rotate(28 311 236)"/>
                            </g>
                            <path class="ilustracion__cono" d="M66 224 H334 L276 418 Q200 436 124 418 Z"/>
                            <path class="ilustracion__rayas" d="M112 224 L150 424 M168 224 L182 430 M232 224 L218 430 M288 224 L250 424"/>
                            <rect class="ilustracion__etiqueta" x="128" y="276" width="144" height="62" rx="4" transform="rotate(-3 200 307)"/>
                            <text class="ilustracion__texto" x="200" y="316" text-anchor="middle" transform="rotate(-3 200 307)">LA FLORESTA</text>
                        </svg>
                    <?php endif; ?>

                    <?php if ($precioDesde !== null): ?>
                        <div class="marco__precio">
                            <small>Precio popular</small>
                            <strong>Desde <?= e(formatoPrecio($precioDesde)) ?></strong>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="marco__pie">
                    <span>Tulancingo de Bravo • La Floresta</span>
                    <span>100% artesanal</span>
                </div>
            </div>

            <button type="button" class="sticker-redondo" id="lluvia-papas" aria-label="Sorpresa: lluvia de papas">
                <span class="material-symbols-outlined" aria-hidden="true">local_fire_department</span>
                <span>Hechas al momento</span>
                <small>¡Tócame!</small>
            </button>
        </div>
    </div>
</section>

<!-- ===================== CINTA ===================== -->
<div class="cinta" aria-hidden="true">
    <div class="cinta__barra">
        <div class="cinta__pista">
            <?php for ($i = 0; $i < 2; $i++): ?>
                <span>🔥 Calientitas y doradas al momento</span><span class="cinta__estrella">★</span>
                <span>Sal, limón y chile al gusto</span><span class="cinta__estrella">★</span>
                <span>Con todo o aparte</span><span class="cinta__estrella">★</span>
                <span>🔥 Recién salidas de la freidora</span><span class="cinta__estrella">★</span>
            <?php endfor; ?>
        </div>
    </div>
</div>

<!-- ===================== LO MÁS PEDIDO ===================== -->
<section class="seccion seccion--productos">
    <div class="contenedor">
        <div class="seccion__cabecera revelar">
            <div>
                <p class="rotulo">Antojos de barrio</p>
                <h2 class="seccion__titulo">¿Qué se te antoja hoy?</h2>
                <p class="seccion__texto">Las consentidas de La Floresta, hechas al momento y con las salsas de la casa.</p>
            </div>
            <a class="boton boton--claro" href="<?= e(urlPagina('menu')) ?>">
                <span>Ver menú completo</span>
                <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
            </a>
        </div>

        <?php if (!$destacados): ?>
            <p class="vacio revelar">Muy pronto verás aquí nuestro menú. Mientras tanto, pídenos por WhatsApp.</p>
        <?php else: ?>
            <div class="ticket-lista">
                <?php foreach ($destacados as $i => $p):
                    $disponible = (int) $p['disponible'] === 1;
                    $foto       = imagenProducto($p['imagen']);
                    $mensaje    = 'Hola, quiero pedir: ' . $p['nombre'] . ' 🍟';
                ?>
                    <article class="ticket revelar<?= $disponible ? '' : ' ticket--agotado' ?>" style="--retraso: <?= (int) ($i * 90) ?>ms">
                        <div class="ticket__cabecera">
                            <span class="ticket__num">Ticket #<?= str_pad((string) $p['id'], 3, '0', STR_PAD_LEFT) ?></span>
                            <span class="ticket__estado<?= $disponible ? '' : ' ticket__estado--agotado' ?>">
                                <?= $disponible ? 'Disponible' : 'Agotado' ?>
                            </span>
                        </div>

                        <h3 class="ticket__nombre"><?= e($p['nombre']) ?></h3>

                        <div class="ticket__foto">
                            <?php if ($foto): ?>
                                <img src="<?= e($foto) ?>" alt="<?= e($p['nombre']) ?>" loading="lazy">
                            <?php else: ?>
                                <div class="foto-vacia" aria-hidden="true">🍟</div>
                            <?php endif; ?>
                            <?php if (!$disponible): ?>
                                <div class="sello"><span>Agotado por hoy</span></div>
                            <?php endif; ?>
                        </div>

                        <div class="ticket__corte" aria-hidden="true"></div>

                        <div class="ticket__cuerpo">
                            <p class="ticket__desc"><?= e($p['descripcion']) ?></p>
                            <div class="ticket__pie">
                                <div class="precio">
                                    <small>Precio</small>
                                    <strong><?= e(formatoPrecio($p['precio'])) ?></strong>
                                </div>
                                <?php if ($disponible): ?>
                                    <a class="boton boton--amarillo boton--chico" href="<?= e(enlaceWhatsapp($mensaje)) ?>" target="_blank" rel="noopener">
                                        <span>Pedir esto</span>
                                        <span class="material-symbols-outlined" aria-hidden="true">add_shopping_cart</span>
                                    </a>
                                <?php else: ?>
                                    <span class="boton boton--chico boton--apagado">No disponible</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- ===================== ASÍ PIDES ===================== -->
<section class="seccion seccion--pasos">
    <div class="contenedor">
        <div class="seccion__cabecera seccion__cabecera--centrada revelar">
            <div>
                <p class="rotulo rotulo--roja">Sin complicaciones</p>
                <h2 class="seccion__titulo">Así de fácil sales comiendo</h2>
                <p class="seccion__texto">Pide desde tu celular y pasa por tus papas cuando estén en su mero punto.</p>
            </div>
        </div>

        <div class="pasos">
            <div class="paso revelar" style="--retraso: 0ms">
                <span class="paso__numero">1</span>
                <h3 class="paso__titulo">Elige del menú</h3>
                <p>Escoge tus favoritas y tus salsas.</p>
            </div>
            <div class="paso revelar" style="--retraso: 90ms">
                <span class="paso__numero">2</span>
                <h3 class="paso__titulo">Mándanos tu pedido</h3>
                <p>Por WhatsApp o con el formulario: dinos qué se te antoja y a qué hora pasas.</p>
            </div>
            <div class="paso revelar" style="--retraso: 180ms">
                <span class="paso__numero">3</span>
                <h3 class="paso__titulo">Pasa por él caliente</h3>
                <p>Llega al puesto y recógelo recién salido de la freidora.</p>
            </div>
        </div>

        <div class="pasos__accion revelar">
            <a class="boton boton--amarillo boton--gigante" href="<?= e(enlaceWhatsapp('Hola, quiero hacer un pedido 🍟')) ?>" target="_blank" rel="noopener">
                <span class="material-symbols-outlined" aria-hidden="true">chat</span>
                <span>Iniciar pedido por WhatsApp</span>
            </a>
        </div>
    </div>
</section>

<!-- ===================== HORARIO Y UBICACIÓN ===================== -->
<section class="banner-horario">
    <div class="contenedor banner-horario__interior">
        <div class="banner-horario__bloque">
            <span class="banner-horario__icono"><span class="material-symbols-outlined" aria-hidden="true">schedule</span></span>
            <div>
                <p class="banner-horario__titulo">Horario del puesto</p>
                <?php foreach (HORARIOS as $grupo): ?>
                    <p><?= e($grupo['etiqueta']) ?>: <?= e(formatoHora12($grupo['abre'])) ?> a <?= e(formatoHora12($grupo['cierra'])) ?></p>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="banner-horario__direccion">
            <span class="material-symbols-outlined" aria-hidden="true">pin_drop</span>
            <span><?= e(DIRECCION) ?></span>
        </div>
    </div>
</section>
