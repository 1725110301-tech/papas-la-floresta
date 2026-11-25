<?php
$logoPie = archivoPublicoExiste('recursos/imagenes/logotipo.png') ? 'recursos/imagenes/logotipo.png' : null;

$redesSociales = [
    'Facebook'  => entorno('FACEBOOK_URL')  ?: 'https://www.facebook.com/share/1FnCUZP9RA/',
    'Instagram' => entorno('INSTAGRAM_URL') ?: 'https://www.instagram.com/papas_a_la_francesa_la_florest',
    'TikTok'    => entorno('TIKTOK_URL')    ?: 'https://www.tiktok.com/@papas.a.la.france4',
];
?>
</main>

<footer class="pie">
    <div class="pie__cinta" aria-hidden="true">
        <span>🍟 Hechas al momento</span><span>★ Salsas de la casa</span><span>🍟 Recién salidas de la freidora</span><span>★ Desde La Floresta</span>
    </div>

    <div class="contenedor pie__rejilla">
        <div class="pie__bloque">
            <?php if ($logoPie): ?>
                <img class="pie__logo-img" src="<?= e($logoPie) ?>" alt="Logotipo de <?= e(NOMBRE_NEGOCIO) ?>" loading="lazy">
            <?php elseif (APP_ENTORNO === 'desarrollo'): ?>

                <div class="pie__logo-hueco"><span>Tu logo aquí</span><small>imagenes/logotipo.png</small></div>
            <?php else: ?>
                <p class="pie__logo">La Floresta</p>
            <?php endif; ?>

            <p>Puesto tradicional de papas a la francesa y botanas en Tulancingo, Hidalgo.</p>

            <p class="pie__titulo pie__titulo--redes">Síguenos</p>
            <div class="redes">
                <a href="<?= e($redesSociales['Facebook']) ?>" aria-label="Facebook" title="Facebook" target="_blank" rel="noopener noreferrer">
                    <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                    </svg>
                </a>
                <a href="<?= e($redesSociales['Instagram']) ?>" aria-label="Instagram" title="Instagram" target="_blank" rel="noopener noreferrer">
                    <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="2" y="2" width="20" height="20" rx="5" />
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                    </svg>
                </a>
                <a href="<?= e($redesSociales['TikTok']) ?>" aria-label="TikTok" title="TikTok" target="_blank" rel="noopener noreferrer">
                    <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor" aria-hidden="true">
                        <path d="M16.6 5.82A4.28 4.28 0 0 1 15.54 3h-3.09v12.4a2.59 2.59 0 0 1-2.59 2.5 2.6 2.6 0 0 1-2.6-2.6 2.6 2.6 0 0 1 3.4-2.47V9.67a5.7 5.7 0 0 0-.8-.06 5.7 5.7 0 0 0-5.7 5.7 5.7 5.7 0 0 0 5.7 5.7 5.7 5.7 0 0 0 5.7-5.7V9a7.3 7.3 0 0 0 4.27 1.37V7.3a4.28 4.28 0 0 1-3.23-1.48z" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="pie__bloque">
            <p class="pie__titulo">Ubicación</p>
            <p><?= e(DIRECCION) ?></p>
            <p class="pie__enlace-fila"><a class="pie__enlace" href="<?= e(urlPagina('ubicacion')) ?>">Ver ubicación y horarios →</a></p>
        </div>

        <div class="pie__bloque">
            <p class="pie__titulo">Horarios</p>
            <ul class="pie__horarios">
                <?php foreach (HORARIOS as $grupo): ?>
                    <li><strong><?= e($grupo['etiqueta']) ?>:</strong> <?= e(formatoHora12($grupo['abre'])) ?> – <?= e(formatoHora12($grupo['cierra'])) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="pie__legal">
        <div class="contenedor">
            <p>© <?= date('Y') ?> <?= e(NOMBRE_NEGOCIO) ?></p>
            <p>Hecho en Tulancingo, Hgo.</p>
        </div>
    </div>
</footer>

<a class="whatsapp-flotante" href="<?= e(enlaceWhatsapp('Hola, quiero hacer un pedido 🍟')) ?>" target="_blank" rel="noopener" aria-label="Pedir por WhatsApp">
    <span class="material-symbols-outlined" aria-hidden="true">chat</span>
</a>

<script type="application/json" id="datos-horarios">
    <?= json_encode(HORARIOS, JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) ?>
</script>
<script src="recursos/javascript/principal.js" defer></script>
</body>

</html>