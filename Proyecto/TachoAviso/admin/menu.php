<?php
/**
 * Menú del escritorio de WordPress.
 *
 * El transportista trabaja en la página pública del panel. El administrador
 * necesita, además, una vista global y los ajustes de los avisos.
 */

if (!defined('ABSPATH')) {
  exit;
}

add_action('admin_menu', 'tachoaviso_admin_menu');
add_action('admin_post_tachoaviso_admin_ajustes', 'tachoaviso_guardar_ajustes_admin');

// tachoaviso_admin_menu()
// Registra el menú y sus dos pantallas.
// No devuelve nada.
function tachoaviso_admin_menu()
{
  add_menu_page(
    'TachoAviso',
    'TachoAviso',
    'manage_tachoaviso',
    'tachoaviso',
    'tachoaviso_admin_panel',
    'dashicons-calendar-alt',
    26
  );

  add_submenu_page('tachoaviso', 'Panel', 'Panel', 'manage_tachoaviso', 'tachoaviso', 'tachoaviso_admin_panel');
  add_submenu_page('tachoaviso', 'Ajustes', 'Ajustes', 'manage_tachoaviso', 'tachoaviso-ajustes', 'tachoaviso_admin_ajustes');
}

// tachoaviso_admin_panel()
// Pinta la vista global con los vencimientos de todos los usuarios.
// No devuelve nada: imprime el HTML de la vista.
function tachoaviso_admin_panel()
{
  if (!current_user_can('manage_tachoaviso')) {
    wp_die('No tienes permisos para ver esta página.');
  }

  $filas = tachoaviso_vencimientos_todos();
  $filas = tachoaviso_completar_filas($filas);
  $filas = tachoaviso_ordenar_por_urgencia($filas);
  $resumen = tachoaviso_resumen($filas);

  include TACHOAVISO_RUTA . 'admin/vistas/panel.php';
}

// tachoaviso_admin_ajustes()
// Pinta el formulario de configuración de los avisos.
// No devuelve nada: imprime el HTML de la vista.
function tachoaviso_admin_ajustes()
{
  if (!current_user_can('manage_tachoaviso')) {
    wp_die('No tienes permisos para ver esta página.');
  }

  $antelaciones = get_option('tachoaviso_antelaciones', [7, 15, 30]);
  $remitente = get_option('tachoaviso_remitente', 'avisos@tachoaviso.es');
  $hora = (int) get_option('tachoaviso_hora', 8);

  include TACHOAVISO_RUTA . 'admin/vistas/ajustes.php';
}

// tachoaviso_guardar_ajustes_admin()
// Guarda las antelaciones, el remitente y la hora de la tarea diaria.
// No devuelve nada: redirige a la pantalla de ajustes.
function tachoaviso_guardar_ajustes_admin()
{
  if (!current_user_can('manage_tachoaviso')) {
    wp_die('No tienes permisos para cambiar los ajustes.');
  }

  check_admin_referer('tachoaviso_admin_ajustes');

  $antelaciones = [];

  foreach (['30', '15', '7'] as $dia) {
    if (isset($_POST['antelacion_' . $dia])) {
      $antelaciones[] = (int) $dia;
    }
  }

  $remitente = isset($_POST['remitente']) ? sanitize_email(wp_unslash($_POST['remitente'])) : '';
  $hora = isset($_POST['hora']) ? (int) $_POST['hora'] : 8;

  update_option('tachoaviso_antelaciones', $antelaciones ? $antelaciones : [7, 15, 30]);
  update_option('tachoaviso_remitente', $remitente ? $remitente : 'avisos@tachoaviso.es');
  update_option('tachoaviso_hora', max(0, min(23, $hora)));

  wp_safe_redirect(add_query_arg('tachoaviso_ok', '1', wp_get_referer()));
  exit;
}
