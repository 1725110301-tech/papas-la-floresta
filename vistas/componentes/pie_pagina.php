</main>

<footer class="pie">
    <div class="pie__cinta" aria-hidden="true">
        <span>🍟 Hechas al momento</span><span>★ Salsas de la casa</span><span>🍟 Recién salidas de la freidora</span><span>★ Desde La Floresta</span>
    </div>

    <div class="contenedor pie__rejilla">
        <div class="pie__bloque">
            <p class="pie__logo">La Floresta</p>
            <p>Puesto tradicional de papas a la francesa y botanas en Tulancingo, Hidalgo.</p>
            <div class="redes">
                <a href="<?= e(FACEBOOK_URL ?: '#') ?>" aria-label="Facebook" target="_blank" rel="noopener">
                    <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </a>
                <a href="<?= e(INSTAGRAM_URL ?: '#') ?>" aria-label="Instagram" target="_blank" rel="noopener">
                    <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                </a>
            </div>
        </div>

        <div class="pie__bloque">
            <p class="pie__titulo">Ubicación</p>
            <p><?= e(DIRECCION) ?></p>
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

<script type="application/json" id="datos-horarios"><?= json_encode(HORARIOS, JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) ?></script>
<script src="recursos/javascript/principal.js" defer></script>
</body>
</html>
