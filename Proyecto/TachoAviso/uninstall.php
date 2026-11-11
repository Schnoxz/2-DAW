<?php
/**
 * Desinstalación del plugin.
 *
 * Por defecto no se borra nada: los datos de los transportistas pueden ser
 * valiosos y una desinstalación accidental no debe destruirlos. Para borrar
 * tablas y ajustes hay que definir TACHOAVISO_BORRAR_DATOS en wp-config.php.
 */

if (!defined('WP_UNINSTALL_PLUGIN')) {
  exit;
}

if (!defined('TACHOAVISO_BORRAR_DATOS') || TACHOAVISO_BORRAR_DATOS !== true) {
  return;
}

global $wpdb;

$tablas = [
  $wpdb->prefix . 'ta_avisos',
  $wpdb->prefix . 'ta_vencimientos',
  $wpdb->prefix . 'ta_conductores',
  $wpdb->prefix . 'ta_vehiculos',
];

foreach ($tablas as $tabla) {
  $wpdb->query("DROP TABLE IF EXISTS {$tabla}");
}

delete_option('tachoaviso_version');
delete_option('tachoaviso_antelaciones');
delete_option('tachoaviso_remitente');
delete_option('tachoaviso_hora');
delete_metadata('user', 0, 'tachoaviso_ajustes', '', true);

remove_role('transportista');
$administrador = get_role('administrator');

if ($administrador) {
  $administrador->remove_cap('manage_tachoaviso');
}
