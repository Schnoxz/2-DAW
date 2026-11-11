<?php
/**
 * Parámetros del negocio y de la aplicación.
 *
 * Todo lo que puede cambiar sin tocar la lógica está aquí: plazos legales,
 * antelaciones de los avisos, colores del semáforo, límites de los planes y
 * rutas de las plantillas. El JavaScript recibe estos mismos valores desde
 * assets/js/config.js y el CSS los toma de sus variables de diseño.
 */

if (!defined('ABSPATH')) {
  exit;
}

// tachoaviso_config($clave = null)
// Devuelve toda la configuración o el valor de una clave concreta.
// Si la clave no existe devuelve null para que la llamada pueda comprobarse.
function tachoaviso_config($clave = null)
{
  $antelaciones = get_option('tachoaviso_antelaciones', [7, 15, 30]);

  if (!is_array($antelaciones) || count($antelaciones) === 0) {
    $antelaciones = [7, 15, 30];
  }

  $config = [
    'version' => TACHOAVISO_VERSION,
    'zona_horaria' => 'Europe/Madrid',
    'idioma' => 'es_ES',

    // Cada trámite guarda los días que pasan entre dos revisiones.
    // ITV y seguro son anuales, pero la fecha real depende del contrato,
    // así que el intervalo solo se usa como valor por defecto.
    'plazos' => [
      'tarjeta_conductor' => [
        'etiqueta' => 'Tarjeta del conductor',
        'dias' => 28,
        'norma' => 'Reglamento (UE) 165/2014',
      ],
      'tarjeta_conductor_g2v2' => [
        'etiqueta' => 'Tarjeta del conductor (G2V2)',
        'dias' => 56,
        'norma' => 'Reglamento (UE) 2016/799',
      ],
      'unidad_vehiculo' => [
        'etiqueta' => 'Unidad del vehículo',
        'dias' => 90,
        'norma' => 'Reglamento (UE) 165/2014',
      ],
      'itv' => [
        'etiqueta' => 'ITV',
        'dias' => 365,
        'norma' => 'Real Decreto 920/2017',
      ],
      'seguro' => [
        'etiqueta' => 'Seguro',
        'dias' => 365,
        'norma' => 'Ley 50/1980',
      ],
    ],

    // Antelaciones en días, de la más urgente a la más lejana.
    'avisos' => [
      'antelaciones' => $antelaciones,
      'hora' => (int) get_option('tachoaviso_hora', 8),
      'remitente' => get_option('tachoaviso_remitente', 'avisos@tachoaviso.es'),
      'nombre_remitente' => 'TachoAviso',
      'asunto' => '[TachoAviso] %s vence el %s',
      'cron' => 'tachoaviso_revisar_avisos',
      'frecuencia' => 'daily',
    ],

    // El semáforo se decide por días restantes, no por colores sueltos.
    'semaforo' => [
      'verde_desde' => 31,
      'ambar_desde' => 8,
      'rojo_hasta' => 7,
    ],

    'limites' => [
      'autonomo' => 3,
      'microflota' => 10,
      'conductores' => 10,
      'altas_por_dia' => 20,
    ],

    // Precio de referencia del MVP, sin IVA y sin permanencia.
    'precios' => [
      'autonomo' => 4,
      'microflota' => 6,
      'moneda' => 'EUR',
      'iva' => 21,
    ],

    'csv' => [
      'separador' => ';',
      'delimitador' => '"',
      'codificacion' => 'UTF-8',
      'nombre' => 'tachoaviso-vencimientos.csv',
    ],

    // Páginas de WordPress que contienen los shortcodes del plugin.
    'paginas' => [
      'panel' => 'panel',
      'acceso' => 'acceso',
      'registro' => 'registro',
      'privacidad' => 'privacidad',
      'cookies' => 'cookies',
      'terminos' => 'terminos',
    ],

    'rutas' => [
      'plantillas' => 'plantillas/',
      'assets' => 'assets/',
    ],
  ];

  if ($clave === null) {
    return $config;
  }

  return isset($config[$clave]) ? $config[$clave] : null;
}

// tachoaviso_plazo($tipo)
// Busca un trámite en la configuración y devuelve su etiqueta y sus días.
// Devuelve null si el tipo no existe, para no calcular vencimientos inventados.
function tachoaviso_plazo($tipo)
{
  $plazos = tachoaviso_config('plazos');

  if (!isset($plazos[$tipo])) {
    return null;
  }

  return $plazos[$tipo];
}

// tachoaviso_antelaciones()
// Devuelve las antelaciones ordenadas de menor a mayor.
// Se ordenan aquí para que el bucle de avisos pueda parar en la primera que toca.
function tachoaviso_antelaciones()
{
  $avisos = tachoaviso_config('avisos');
  $dias = $avisos['antelaciones'];
  sort($dias, SORT_NUMERIC);

  return $dias;
}

// tachoaviso_url_pagina($clave)
// Devuelve la URL de una página del plugin a partir de su slug.
// Si la página no existe devuelve la URL de inicio de WordPress.
function tachoaviso_url_pagina($clave)
{
  $paginas = tachoaviso_config('paginas');

  if (!isset($paginas[$clave])) {
    return home_url('/');
  }

  $pagina = get_page_by_path($paginas[$clave]);

  // get_permalink(null) devolvería la entrada actual, no la portada: por eso
  // se comprueba la página antes de pedir su enlace.
  if (!$pagina) {
    return home_url('/');
  }

  $url = get_permalink($pagina);

  return $url ? $url : home_url('/');
}
