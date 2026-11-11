<?php
/**
 * Activación y desactivación del plugin.
 *
 * La activación crea las tablas, el rol del transportista y la tarea diaria.
 * La desactivación solo quita la tarea: los datos se conservan hasta que el
 * administrador decida borrarlos desde uninstall.php.
 */

if (!defined('ABSPATH')) {
  exit;
}

// tachoaviso_activar()
// Crea las tablas, el rol y la tarea programada al activar el plugin.
// No devuelve nada; deja el plugin listo para usarse.
function tachoaviso_activar()
{
  global $wpdb;

  if (!function_exists('dbDelta')) {
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
  }

  $esquema = file_get_contents(TACHOAVISO_RUTA . 'sql/esquema.sql');

  if ($esquema) {
    $esquema = str_replace(
      ['{prefix}', '{charset}'],
      [$wpdb->prefix, $wpdb->get_charset_collate()],
      $esquema
    );
    dbDelta($esquema);
  }

  add_role('transportista', 'Transportista', [
    'read' => true,
    'manage_tachoaviso' => true,
  ]);

  $administrador = get_role('administrator');

  if ($administrador) {
    $administrador->add_cap('manage_tachoaviso');
  }

  $avisos = tachoaviso_config('avisos');
  $zona = new DateTimeZone(tachoaviso_config('zona_horaria'));
  $primera = new DateTimeImmutable('tomorrow ' . $avisos['hora'] . ':00', $zona);

  if (!wp_next_scheduled($avisos['cron'])) {
    wp_schedule_event($primera->getTimestamp(), $avisos['frecuencia'], $avisos['cron']);
  }

  update_option('tachoaviso_version', TACHOAVISO_VERSION);
}

// tachoaviso_desactivar()
// Cancela la tarea programada para que no queden correos pendientes.
// No borra tablas ni datos de los usuarios.
function tachoaviso_desactivar()
{
  $avisos = tachoaviso_config('avisos');
  wp_clear_scheduled_hook($avisos['cron']);
}
