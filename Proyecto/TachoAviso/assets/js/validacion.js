/*
 * TachoAviso · validación de formularios en el navegador.
 *
 * La validación del servidor sigue siendo obligatoria. Esta solo evita enviar
 * un formulario con la matrícula mal escrita o la fecha vacía y explica el
 * error al lado del campo, no en una ventana emergente.
 */

(function () {
  'use strict';

  var formularios = document.querySelectorAll('form');

  function campoError(campo) {
    return document.querySelector('[data-error-de="' + campo.id + '"]');
  }

  function marcarError(campo, texto) {
    var salida = campoError(campo);

    campo.setAttribute('aria-invalid', 'true');

    if (salida) {
      salida.textContent = texto;

      if (!salida.id) {
        salida.id = 'error-' + campo.id;
      }

      campo.setAttribute('aria-describedby', salida.id);
    }
  }

  function limpiarError(campo) {
    var salida = campoError(campo);

    campo.removeAttribute('aria-invalid');

    if (salida) {
      salida.textContent = '';
    }
  }

  function validarCampo(campo) {
    var valor = campo.type === 'checkbox' ? campo.checked : String(campo.value || '').trim();
    var tipo = campo.getAttribute('data-validar') || '';

    if (campo.required && (campo.type === 'checkbox' ? !valor : valor === '')) {
      marcarError(campo, 'Este campo es obligatorio.');
      return false;
    }

    if (valor === '') {
      limpiarError(campo);
      return true;
    }

    if (tipo === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(String(valor))) {
      marcarError(campo, 'Escribe un correo válido.');
      return false;
    }

    if (tipo === 'password' && String(valor).length < 8) {
      marcarError(campo, 'La contraseña debe tener al menos 8 caracteres.');
      return false;
    }

    if (tipo === 'texto' && String(valor).length < 2) {
      marcarError(campo, 'Escribe al menos 2 caracteres.');
      return false;
    }

    if (tipo === 'matricula') {
      var limpia = String(valor).toUpperCase().replace(/[\s-]+/g, '');

      if (!/^[0-9]{4}[A-Z]{3}$/.test(limpia) && !/^[A-Z]{1,2}[0-9]{4}[A-Z]{0,2}$/.test(limpia)) {
        marcarError(campo, 'Formato esperado: 1234 ABC o AB 1234 CD.');
        return false;
      }
    }

    if (tipo === 'fecha' && !/^\d{4}-\d{2}-\d{2}$/.test(String(valor))) {
      marcarError(campo, 'Elige una fecha válida.');
      return false;
    }

    if (tipo === 'numero' && Number(valor) < 1) {
      marcarError(campo, 'El intervalo debe ser mayor que cero.');
      return false;
    }

    limpiarError(campo);
    return true;
  }

  function validarFormulario(form) {
    var campos = form.querySelectorAll('[required], [data-validar]');
    var valido = true;
    var primero = null;

    for (var i = 0; i < campos.length; i++) {
      if (!validarCampo(campos[i])) {
        valido = false;

        if (!primero) {
          primero = campos[i];
        }
      }
    }

    if (primero) {
      primero.focus();
    }

    return valido;
  }

  for (var i = 0; i < formularios.length; i++) {
    var form = formularios[i];
    var campos = form.querySelectorAll('[required], [data-validar]');

    for (var j = 0; j < campos.length; j++) {
      campos[j].addEventListener('blur', function () {
        validarCampo(this);
      });

      campos[j].addEventListener('input', function () {
        if (this.getAttribute('aria-invalid') === 'true') {
          validarCampo(this);
        }
      });
    }

    form.addEventListener('submit', function (evento) {
      if (!validarFormulario(this)) {
        evento.preventDefault();
      }
    });
  }

  window.TachoAviso = window.TachoAviso || {};
  window.TachoAviso.validarFormulario = validarFormulario;
})();
