<?php
/**
 * Shortcodes, assets y datos para JavaScript.
 *
 * La landing, el acceso y el panel son páginas normales de WordPress. Cada una
 * lleva un shortcode que pinta su plantilla y carga solo los assets que usa.
 */

if (!defined('ABSPATH')) {
  exit;
}

add_shortcode('tachoaviso_landing', 'tachoaviso_shortcode_landing');
add_shortcode('tachoaviso_acceso', 'tachoaviso_shortcode_acceso');
add_shortcode('tachoaviso_panel', 'tachoaviso_shortcode_panel');

// tachoaviso_shortcode_landing()
// Pinta la landing pública completa.
// Devuelve el HTML ya generado para que WordPress lo inserte en la página.
function tachoaviso_shortcode_landing()
{
  tachoaviso_cargar_assets('landing');

  ob_start();
  include TACHOAVISO_RUTA . 'plantillas/landing.php';

  return ob_get_clean();
}

// tachoaviso_shortcode_acceso()
// Pinta el formulario de entrada y el de registro.
// Devuelve el HTML generado; si ya hay sesión, muestra un enlace al panel.
function tachoaviso_shortcode_acceso()
{
  tachoaviso_cargar_assets('acceso');

  ob_start();
  include TACHOAVISO_RUTA . 'plantillas/acceso.php';

  return ob_get_clean();
}

// tachoaviso_shortcode_panel()
// Pinta el panel privado con los vencimientos del usuario conectado.
// Devuelve el HTML; si no hay sesión, incluye el formulario de acceso.
function tachoaviso_shortcode_panel()
{
  if (!tachoaviso_puede_gestionar()) {
    return tachoaviso_shortcode_acceso();
  }

  tachoaviso_cargar_assets('panel');

  $usuario_id = tachoaviso_usuario_id();
  $vehiculos = tachoaviso_obtener_vehiculos($usuario_id);
  $conductores = tachoaviso_obtener_conductores($usuario_id);
  $vencimientos = tachoaviso_vencimientos_con_estado($usuario_id);
  $resumen = tachoaviso_resumen($vencimientos);
  $ajustes = tachoaviso_ajustes_usuario($usuario_id);

  ob_start();
  include TACHOAVISO_RUTA . 'plantillas/panel.php';

  return ob_get_clean();
}

// tachoaviso_cargar_assets($vista)
// Encola las hojas de estilo y los scripts que necesita una vista.
// Añade a TachoAvisoDatos los valores que el JavaScript no puede calcular solo.
function tachoaviso_cargar_assets($vista)
{
  $css = TACHOAVISO_URL . 'assets/css/';
  $js = TACHOAVISO_URL . 'assets/js/';

  wp_enqueue_style('tachoaviso-base', $css . 'base.css', [], TACHOAVISO_VERSION);

  if ($vista === 'landing') {
    wp_enqueue_style('tachoaviso-landing', $css . 'landing.css', ['tachoaviso-base'], TACHOAVISO_VERSION);
    wp_enqueue_script('tachoaviso-landing', $js . 'landing.js', [], TACHOAVISO_VERSION, true);
  }

  if ($vista === 'acceso') {
    wp_enqueue_style('tachoaviso-acceso', $css . 'panel.css', ['tachoaviso-base'], TACHOAVISO_VERSION);
    wp_enqueue_script('tachoaviso-config', $js . 'config.js', [], TACHOAVISO_VERSION, true);
    wp_enqueue_script('tachoaviso-validacion', $js . 'validacion.js', ['tachoaviso-config'], TACHOAVISO_VERSION, true);
  }

  if ($vista === 'panel') {
    wp_enqueue_style('tachoaviso-panel', $css . 'panel.css', ['tachoaviso-base'], TACHOAVISO_VERSION);
    wp_enqueue_script('tachoaviso-config', $js . 'config.js', [], TACHOAVISO_VERSION, true);
    wp_enqueue_script('tachoaviso-validacion', $js . 'validacion.js', ['tachoaviso-config'], TACHOAVISO_VERSION, true);
    wp_enqueue_script('tachoaviso-panel', $js . 'panel.js', ['tachoaviso-config', 'tachoaviso-validacion'], TACHOAVISO_VERSION, true);
  }

  if (wp_script_is('tachoaviso-config', 'enqueued')) {
    wp_localize_script('tachoaviso-config', 'TachoAvisoDatos', tachoaviso_datos_js($vista));
  }
}

// tachoaviso_datos_js($vista)
// Prepara el objeto que config.js y panel.js leen desde window.
// Devuelve solo datos ya escapados o convertidos a tipos simples.
function tachoaviso_datos_js($vista)
{
  $usuario_id = tachoaviso_usuario_id();
  $usuario = $usuario_id ? get_userdata($usuario_id) : null;
  $plazos = [];

  foreach (tachoaviso_config('plazos') as $clave => $plazo) {
    $plazos[] = [
      'valor' => $clave,
      'etiqueta' => $plazo['etiqueta'],
      'dias' => (int) $plazo['dias'],
    ];
  }

  $datos = [
    'conectado' => (bool) $usuario_id,
    'usuario' => $usuario ? $usuario->display_name : '',
    'nonce' => tachoaviso_nonce('accion'),
    'adminPost' => admin_url('admin-post.php'),
    'urlPanel' => tachoaviso_url_pagina('panel'),
    'urlAcceso' => tachoaviso_url_pagina('acceso'),
    'plazos' => $plazos,
    'semaforo' => tachoaviso_config('semaforo'),
    'avisos' => tachoaviso_antelaciones(),
    'precios' => tachoaviso_config('precios'),
    'textos' => [
      'sinDatos' => 'Todavía no hay vencimientos. Da de alta un vehículo y su primer trámite.',
      'vencido' => 'Vencido',
      'venceHoy' => 'Vence hoy',
      'dias' => 'días',
    ],
  ];

  if ($vista === 'panel') {
    $datos['vencimientos'] = tachoaviso_vencimientos_con_estado($usuario_id);
    $datos['vehiculos'] = tachoaviso_obtener_vehiculos($usuario_id);
    $datos['conductores'] = tachoaviso_obtener_conductores($usuario_id);
  }

  return $datos;
}
