/*
 * TachoAviso · landing pública
 *
 * En pantallas estrechas el menú se guarda detrás de un botón. Se cierra al
 * elegir un enlace y al volver al tamaño de escritorio para que no quede una
 * capa abierta encima del contenido.
 */

(function () {
  'use strict';

  var boton = document.querySelector('.ta-menu-boton');
  var nav = document.getElementById('ta-nav');

  if (!boton || !nav) {
    return;
  }

  function abrir() {
    nav.classList.add('ta-nav--abierta');
    boton.setAttribute('aria-expanded', 'true');
  }

  function cerrar() {
    nav.classList.remove('ta-nav--abierta');
    boton.setAttribute('aria-expanded', 'false');
  }

  boton.addEventListener('click', function () {
    if (nav.classList.contains('ta-nav--abierta')) {
      cerrar();
    } else {
      abrir();
    }
  });

  // Al pulsar un enlace el menú sobra: el navegador ya va a saltar a la sección.
  nav.addEventListener('click', function (evento) {
    if (evento.target.tagName === 'A') {
      cerrar();
    }
  });

  document.addEventListener('keydown', function (evento) {
    if (evento.key === 'Escape') {
      cerrar();
    }
  });

  window.addEventListener('resize', function () {
    if (window.innerWidth > 900) {
      cerrar();
    }
  });
})();
