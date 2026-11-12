<?php
/**
 * Plugin Name: TachoAviso
 * Plugin URI:  https://tachoaviso.es
 * Description: Control de vencimientos legales para transportistas autónomos y microflotas.
 * Version:     0.1.0
 * Author:      Javier Jiménez Alonso
 * Text Domain: tachoaviso
 * Requires PHP: 8.0
 */

// WordPress no debe cargar este archivo si se abre directamente por la web.
if (!defined('ABSPATH')) {
  exit;
}

define('TACHOAVISO_VERSION', '0.1.0');
define('TACHOAVISO_RUTA', plugin_dir_path(__FILE__));
define('TACHOAVISO_URL', plugin_dir_url(__FILE__));

// El orden importa: la configuración no depende de nadie y el resto sí.
require_once TACHOAVISO_RUTA . 'includes/config.php';
require_once TACHOAVISO_RUTA . 'includes/vencimientos.php';
require_once TACHOAVISO_RUTA . 'includes/seguridad.php';
require_once TACHOAVISO_RUTA . 'includes/base-datos.php';
require_once TACHOAVISO_RUTA . 'includes/activacion.php';
require_once TACHOAVISO_RUTA . 'includes/avisos.php';
require_once TACHOAVISO_RUTA . 'includes/acciones.php';
require_once TACHOAVISO_RUTA . 'includes/shortcodes.php';

if (is_admin()) {
  require_once TACHOAVISO_RUTA . 'admin/menu.php';
}

register_activation_hook(__FILE__, 'tachoaviso_activar');
register_deactivation_hook(__FILE__, 'tachoaviso_desactivar');

add_action('plugins_loaded', 'tachoaviso_iniciar');

// tachoaviso_iniciar()
// Carga las traducciones y engancha la tarea programada al arrancar el plugin.
// No devuelve nada.
function tachoaviso_iniciar()
{
  load_plugin_textdomain('tachoaviso', false, dirname(plugin_basename(__FILE__)) . '/languages');
  add_action('tachoaviso_revisar_avisos', 'tachoaviso_revisar_avisos');
  add_action('init', 'tachoaviso_programar_avisos');
}
