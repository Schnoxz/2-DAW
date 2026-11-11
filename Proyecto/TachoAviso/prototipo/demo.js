/*
 * TachoAviso · datos de la demo estática
 *
 * Este archivo solo se carga en prototipo/. Sustituye a lo que en WordPress
 * genera wp_localize_script y calcula las fechas respecto a hoy, para que el
 * semáforo siempre tenga un caso rojo, uno ámbar y uno verde.
 */

(function () {
  'use strict';

  function fechaDeHoy() {
    var ahora = new Date();

    return new Date(ahora.getFullYear(), ahora.getMonth(), ahora.getDate());
  }

  function aTexto(fecha) {
    var mes = String(fecha.getMonth() + 1).padStart(2, '0');
    var dia = String(fecha.getDate()).padStart(2, '0');

    return fecha.getFullYear() + '-' + mes + '-' + dia;
  }

  function sumar(dias) {
    var fecha = fechaDeHoy();
    fecha.setDate(fecha.getDate() + Number(dias));

    return aTexto(fecha);
  }

  window.TachoAvisoDatos = {
    demo: true,
    conectado: true,
    usuario: 'Transportes García',
    nonce: 'demo',
    adminPost: 'panel.html',
    urlPanel: 'panel.html',
    urlAcceso: 'acceso.html',

    plazos: [
      { valor: 'tarjeta_conductor', etiqueta: 'Tarjeta del conductor', dias: 28 },
      { valor: 'tarjeta_conductor_g2v2', etiqueta: 'Tarjeta del conductor (G2V2)', dias: 56 },
      { valor: 'unidad_vehiculo', etiqueta: 'Unidad del vehículo', dias: 90 },
      { valor: 'itv', etiqueta: 'ITV', dias: 365 },
      { valor: 'seguro', etiqueta: 'Seguro', dias: 365 }
    ],

    semaforo: {
      verde_desde: 31,
      ambar_desde: 8,
      rojo_hasta: 7
    },

    avisos: [7, 15, 30],

    precios: {
      autonomo: 4,
      microflota: 6,
      moneda: 'EUR',
      iva: 21
    },

    textos: {
      sinDatos: 'Todavía no hay vencimientos. Da de alta un vehículo y su primer trámite.',
      vencido: 'Vencido',
      venceHoy: 'Vence hoy',
      dias: 'días'
    },

    // Cada fila guarda la fecha real de vencimiento; los días y el color los
    // calcula config.js con las mismas reglas que includes/vencimientos.php.
    vencimientos: [
      {
        id: 1,
        tipo: 'tarjeta_conductor',
        matricula: '1234 ABC',
        vehiculo_alias: 'Camión 1',
        conductor_alias: 'Luis',
        intervalo_dias: 28,
        fecha_referencia: sumar(-31),
        fecha_vencimiento: sumar(-3),
        notas: ''
      },
      {
        id: 2,
        tipo: 'unidad_vehiculo',
        matricula: '4567 DEF',
        vehiculo_alias: 'Camión 2',
        conductor_alias: 'Marta',
        intervalo_dias: 90,
        fecha_referencia: sumar(-86),
        fecha_vencimiento: sumar(4),
        notas: ''
      },
      {
        id: 3,
        tipo: 'itv',
        matricula: '7890 GHI',
        vehiculo_alias: 'Camión 3',
        conductor_alias: '',
        intervalo_dias: 365,
        fecha_referencia: sumar(-353),
        fecha_vencimiento: sumar(12),
        notas: 'Cita pedida en la estación de San Roque'
      },
      {
        id: 4,
        tipo: 'tarjeta_conductor_g2v2',
        matricula: '2345 JKL',
        vehiculo_alias: 'Furgoneta',
        conductor_alias: 'Ana',
        intervalo_dias: 56,
        fecha_referencia: sumar(-35),
        fecha_vencimiento: sumar(21),
        notas: ''
      },
      {
        id: 5,
        tipo: 'seguro',
        matricula: '3456 MNO',
        vehiculo_alias: 'Camión 4',
        conductor_alias: '',
        intervalo_dias: 365,
        fecha_referencia: sumar(-317),
        fecha_vencimiento: sumar(48),
        notas: 'Renovación con la misma póliza'
      },
      {
        id: 6,
        tipo: 'tarjeta_conductor',
        matricula: '4567 DEF',
        vehiculo_alias: 'Camión 2',
        conductor_alias: 'Marta',
        intervalo_dias: 28,
        fecha_referencia: sumar(47),
        fecha_vencimiento: sumar(75),
        notas: ''
      }
    ]
  };

  // La fecha del saludo se rellena aquí porque en la demo no hay PHP que la pinte.
  document.addEventListener('DOMContentLoaded', function () {
    var salida = document.querySelector('[data-hoy]');

    if (!salida) {
      return;
    }

    var hoy = fechaDeHoy();
    var dia = String(hoy.getDate()).padStart(2, '0');
    var mes = String(hoy.getMonth() + 1).padStart(2, '0');

    salida.textContent = dia + '/' + mes + '/' + hoy.getFullYear();
  });
})();
