
(function () {
    'use strict';

    var reducirMovimiento = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var DIAS = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
    var encabezado = document.querySelector('.encabezado');

    function alDesplazar() {
        if (encabezado) {
            encabezado.classList.toggle('con-sombra', window.scrollY > 8);
        }
    }
    window.addEventListener('scroll', alDesplazar, { passive: true });
    alDesplazar();

    var revelables = document.querySelectorAll('.revelar');

    if ('IntersectionObserver' in window && !reducirMovimiento) {
        var observador = new IntersectionObserver(function (entradas) {
            entradas.forEach(function (entrada) {
                if (entrada.isIntersecting) {
                    entrada.target.classList.add('visible');
                    observador.unobserve(entrada.target);
                }
            });
        }, { threshold: 0.12 });

        revelables.forEach(function (el) { observador.observe(el); });
    } else {
        revelables.forEach(function (el) { el.classList.add('visible'); });
    }
    function aMinutos(hora) {
        var partes = hora.split(':');
        return parseInt(partes[0], 10) * 60 + parseInt(partes[1], 10);
    }

    function formato12(hora) {
        var partes = hora.split(':');
        var h = parseInt(partes[0], 10);
        var m = partes[1];
        var sufijo = h >= 12 ? 'PM' : 'AM';
        var h12 = h % 12 === 0 ? 12 : h % 12;
        return h12 + ':' + m + ' ' + sufijo;
    }

    function calcularEstado(horarios, ahora) {
        var dia = ahora.getDay();
        var ayer = (dia + 6) % 7;
        var min = ahora.getHours() * 60 + ahora.getMinutes();
        var i, g, abre, cierra, cruzaMedianoche;

        for (i = 0; i < horarios.length; i++) {
            g = horarios[i];
            abre = aMinutos(g.abre);
            cierra = aMinutos(g.cierra);
            cruzaMedianoche = cierra <= abre;

            if (g.dias.indexOf(dia) !== -1) {
                if (!cruzaMedianoche && min >= abre && min < cierra) { return { abierto: true, cierra: g.cierra }; }
                if (cruzaMedianoche && min >= abre) { return { abierto: true, cierra: g.cierra }; }
            }

            if (cruzaMedianoche && g.dias.indexOf(ayer) !== -1 && min < cierra) {
                return { abierto: true, cierra: g.cierra };
            }
        }
        for (var desfase = 0; desfase < 8; desfase++) {
            var diaBuscado = (dia + desfase) % 7;
            var mejor = null;
            for (i = 0; i < horarios.length; i++) {
                g = horarios[i];
                if (g.dias.indexOf(diaBuscado) === -1) { continue; }
                if (desfase === 0 && aMinutos(g.abre) <= min) { continue; }
                if (mejor === null || aMinutos(g.abre) < aMinutos(mejor.abre)) { mejor = g; }
            }
            if (mejor) { return { abierto: false, abre: mejor.abre, desfase: desfase, dia: diaBuscado }; }
        }
        return null;
    }

    var letrero = document.getElementById('estado-abierto');
    var letreroTexto = document.getElementById('estado-abierto-texto');
    var datosHorarios = document.getElementById('datos-horarios');

    function actualizarLetrero() {
        if (!letrero || !letreroTexto || !datosHorarios) { return; }
        var horarios;
        try { horarios = JSON.parse(datosHorarios.textContent); } catch (e) { return; }

        var estado = calcularEstado(horarios, new Date());
        if (!estado) { return; }

        if (estado.abierto) {
            letrero.setAttribute('data-estado', 'abierto');
            letreroTexto.textContent = '¡Abierto ahora! Cerramos a las ' + formato12(estado.cierra);
        } else {
            letrero.setAttribute('data-estado', 'cerrado');
            var cuando = estado.desfase === 0 ? 'hoy'
                : estado.desfase === 1 ? 'mañana'
                    : 'el ' + DIAS[estado.dia];
            letreroTexto.textContent = 'Cerrado ahora · Abrimos ' + cuando + ' a las ' + formato12(estado.abre);
        }
    }
    actualizarLetrero();
    setInterval(actualizarLetrero, 60000);

    var botonLluvia = document.getElementById('lluvia-papas');

    if (botonLluvia) {
        botonLluvia.addEventListener('click', function () {
            if (reducirMovimiento) { return; }
            for (var i = 0; i < 24; i++) {
                var papa = document.createElement('span');
                papa.className = 'papa-cae';
                papa.textContent = '🍟';
                papa.setAttribute('aria-hidden', 'true');
                papa.style.left = (Math.random() * 96) + 'vw';
                papa.style.fontSize = (1.4 + Math.random() * 1.8) + 'rem';
                papa.style.animationDuration = (1.5 + Math.random() * 1.5) + 's';
                papa.style.animationDelay = (Math.random() * 0.7) + 's';
                papa.addEventListener('animationend', function () { this.remove(); });
                document.body.appendChild(papa);
            }
        });
    }
})();
