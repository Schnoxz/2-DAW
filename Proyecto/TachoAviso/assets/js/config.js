/*
 * TachoAviso · configuración y cálculo de fechas en el navegador.
 *
 * Los valores llegan de WordPress en TachoAvisoDatos (wp_localize_script).
 * En la demo estática los pone demo.js. La lógica es la misma que la de
 * includes/vencimientos.php para que el panel no enseñe dos resultados distintos.
 */

window.TachoAviso = window.TachoAviso || {};

(function () {
  'use strict';

  var datos = window.TachoAvisoDatos || {};

  var config = {
    demo: Boolean(datos.demo),
    semaforo: datos.semaforo || { verde_desde: 31, ambar_desde: 8, rojo_hasta: 7 },
    avisos: datos.avisos || [7, 15, 30],
    plazos: datos.plazos || [],
    textos: datos.textos || {},
    urls: {
      panel: datos.urlPanel || 'panel.html',
      acceso: datos.urlAcceso || 'acceso.html',
      adminPost: datos.adminPost || ''
    }
  };

  var MS_DIA = 86400000;

  function parseFecha(valor) {
    if (valor instanceof Date) {
      return new Date(valor.getFullYear(), valor.getMonth(), valor.getDate());
    }

    if (typeof valor === 'string' && /^\d{4}-\d{2}-\d{2}$/.test(valor)) {
      var partes = valor.split('-');
      return new Date(Number(partes[0]), Number(partes[1]) - 1, Number(partes[2]));
    }

    var fecha = new Date(valor);

    if (isNaN(fecha.getTime())) {
      return null;
    }

    return new Date(fecha.getFullYear(), fecha.getMonth(), fecha.getDate());
  }

  function aUTC(fecha) {
    return Date.UTC(fecha.getFullYear(), fecha.getMonth(), fecha.getDate());
  }

  function fechaISO(fecha) {
    var anio = fecha.getFullYear();
    var mes = String(fecha.getMonth() + 1).padStart(2, '0');
    var dia = String(fecha.getDate()).padStart(2, '0');

    return anio + '-' + mes + '-' + dia;
  }

  function hoyISO() {
    return fechaISO(new Date());
  }

  function sumarDias(fecha, dias) {
    var base = parseFecha(fecha);

    if (!base) {
      return null;
    }

    base.setDate(base.getDate() + Number(dias));

    return fechaISO(base);
  }

  function diasRestantes(fecha, hoy) {
    var fin = parseFecha(fecha);
    var referencia = hoy ? parseFecha(hoy) : parseFecha(new Date());

    if (!fin || !referencia) {
      return null;
    }

    return Math.round((aUTC(fin) - aUTC(referencia)) / MS_DIA);
  }

  function estadoSemaforo(dias) {
    if (dias === null || typeof dias === 'undefined') {
      return 'desconocido';
    }

    if (dias < 0 || dias <= config.semaforo.rojo_hasta) {
      return 'rojo';
    }

    if (dias < config.semaforo.verde_desde) {
      return 'ambar';
    }

    return 'verde';
  }

  function textoEstado(dias) {
    if (dias === null || typeof dias === 'undefined') {
      return 'Sin fecha';
    }

    if (dias < 0) {
      var pasados = Math.abs(dias);

      return 'Vencido hace ' + pasados + (pasados === 1 ? ' día' : ' días');
    }

    if (dias === 0) {
      return 'Vence hoy';
    }

    if (dias === 1) {
      return 'Vence mañana';
    }

    return 'Quedan ' + dias + ' días';
  }

  function formatearFecha(fecha) {
    var valor = parseFecha(fecha);

    if (!valor) {
      return '—';
    }

    return new Intl.DateTimeFormat('es-ES', {
      day: '2-digit',
      month: '2-digit',
      year: 'numeric'
    }).format(valor);
  }

  function etiquetaPlazo(tipo) {
    for (var i = 0; i < config.plazos.length; i++) {
      if (config.plazos[i].valor === tipo) {
        return config.plazos[i].etiqueta;
      }
    }

    return tipo;
  }

  function intervaloPlazo(tipo) {
    for (var i = 0; i < config.plazos.length; i++) {
      if (config.plazos[i].valor === tipo) {
        return Number(config.plazos[i].dias);
      }
    }

    return 28;
  }

  window.TachoAviso.config = config;
  window.TachoAviso.parseFecha = parseFecha;
  window.TachoAviso.fechaISO = fechaISO;
  window.TachoAviso.hoyISO = hoyISO;
  window.TachoAviso.sumarDias = sumarDias;
  window.TachoAviso.diasRestantes = diasRestantes;
  window.TachoAviso.estadoSemaforo = estadoSemaforo;
  window.TachoAviso.textoEstado = textoEstado;
  window.TachoAviso.formatearFecha = formatearFecha;
  window.TachoAviso.etiquetaPlazo = etiquetaPlazo;
  window.TachoAviso.intervaloPlazo = intervaloPlazo;
})();
