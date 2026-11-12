<?php
/**
 * Acciones de los formularios.
 *
 * Todas las peticiones llegan a admin-post.php con un campo «accion». Aquí se
 * comprueba el nonce, los permisos y los datos, y se vuelve a la página con un
 * mensaje corto en la URL. Nunca se procesa nada por GET.
 */

if (!defined('ABSPATH')) {
  exit;
}

add_action('admin_post_tachoaviso_accion', 'tachoaviso_procesar_accion');
add_action('admin_post_nopriv_tachoaviso_accion', 'tachoaviso_procesar_accion');
add_action('admin_post_tachoaviso_exportar', 'tachoaviso_exportar_csv');

// tachoaviso_procesar_accion()
// Atiende el formulario recibido y redirige con el resultado.
// No devuelve nada: termina siempre en una redirección.
function tachoaviso_procesar_accion()
{
  $accion = isset($_POST['accion']) ? sanitize_key(wp_unslash($_POST['accion'])) : '';
  $nonce = isset($_POST['tachoaviso_nonce']) ? sanitize_text_field(wp_unslash($_POST['tachoaviso_nonce'])) : '';

  if (!tachoaviso_nonce_valido($nonce, 'accion')) {
    tachoaviso_volver('panel', 'error', 'La petición ha caducado. Vuelve a intentarlo.');
  }

  switch ($accion) {
    case 'registro':
      tachoaviso_accion_registro();
      break;
    case 'login':
      tachoaviso_accion_login();
      break;
    case 'guardar_vehiculo':
      tachoaviso_accion_guardar_vehiculo();
      break;
    case 'guardar_conductor':
      tachoaviso_accion_guardar_conductor();
      break;
    case 'guardar_vencimiento':
      tachoaviso_accion_guardar_vencimiento();
      break;
    case 'marcar_hecho':
      tachoaviso_accion_marcar_hecho();
      break;
    case 'guardar_ajustes':
      tachoaviso_accion_guardar_ajustes();
      break;
    default:
      tachoaviso_volver('panel', 'error', 'Acción no reconocida.');
  }
}

// tachoaviso_volver($pagina, $estado, $mensaje)
// Redirige a una página del plugin con un aviso legible.
// No devuelve nada: la ejecución termina en la redirección.
function tachoaviso_volver($pagina, $estado, $mensaje)
{
  $url = add_query_arg([
    'tachoaviso_estado' => $estado,
    'tachoaviso_mensaje' => $mensaje,
  ], tachoaviso_url_pagina($pagina));

  wp_safe_redirect($url);
  exit;
}

// tachoaviso_accion_registro()
// Crea un usuario con rol transportista y lo deja conectado.
// No devuelve nada: redirige al panel o al acceso con el error.
function tachoaviso_accion_registro()
{
  $nombre = tachoaviso_limpiar($_POST['nombre'] ?? '');
  $email = sanitize_email(wp_unslash($_POST['email'] ?? ''));
  $password = (string) wp_unslash($_POST['password'] ?? '');
  $acepta = isset($_POST['privacidad']);

  if ($nombre === '' || !tachoaviso_email_valido($email) || strlen($password) < 8 || !$acepta) {
    tachoaviso_volver('acceso', 'error', 'Revisa el nombre, el correo, la contraseña (8 caracteres) y la casilla de privacidad.');
  }

  if (email_exists($email) || username_exists($email)) {
    tachoaviso_volver('acceso', 'error', 'Ese correo ya tiene una cuenta. Entra con tu contraseña.');
  }

  $usuario_id = wp_create_user($email, $password, $email);

  if (is_wp_error($usuario_id)) {
    tachoaviso_volver('acceso', 'error', 'No se ha podido crear la cuenta.');
  }

  $usuario = new WP_User($usuario_id);
  $usuario->set_role('transportista');
  wp_update_user(['ID' => $usuario_id, 'display_name' => $nombre]);

  wp_set_current_user($usuario_id);
  wp_set_auth_cookie($usuario_id);

  tachoaviso_volver('panel', 'ok', 'Cuenta creada. Ya puedes dar de alta tu primer vehículo.');
}

// tachoaviso_accion_login()
// Inicia sesión con correo y contraseña.
// No devuelve nada: redirige al panel o al acceso con el error.
function tachoaviso_accion_login()
{
  $email = sanitize_email(wp_unslash($_POST['email'] ?? ''));
  $password = (string) wp_unslash($_POST['password'] ?? '');

  $usuario = wp_signon([
    'user_login' => $email,
    'user_password' => $password,
    'remember' => true,
  ], is_ssl());

  if (is_wp_error($usuario)) {
    tachoaviso_volver('acceso', 'error', 'El correo o la contraseña no son correctos.');
  }

  tachoaviso_volver('panel', 'ok', 'Sesión iniciada.');
}

// tachoaviso_accion_guardar_vehiculo()
// Comprueba el límite del plan y guarda el vehículo.
// No devuelve nada: redirige al panel con el resultado.
function tachoaviso_accion_guardar_vehiculo()
{
  $usuario_id = tachoaviso_usuario_id();
  $limite = (int) tachoaviso_config('limites')['microflota'];

  if (tachoaviso_contar_vehiculos($usuario_id) >= $limite) {
    tachoaviso_volver('panel', 'error', 'Has llegado al límite de vehículos del plan.');
  }

  $resultado = tachoaviso_guardar_vehiculo([
    'usuario_id' => $usuario_id,
    'matricula' => $_POST['matricula'] ?? '',
    'alias' => $_POST['alias'] ?? '',
    'marca' => $_POST['marca'] ?? '',
  ]);

  if (is_wp_error($resultado)) {
    tachoaviso_volver('panel', 'error', $resultado->get_error_message());
  }

  tachoaviso_volver('panel', 'ok', 'Vehículo guardado.');
}

// tachoaviso_accion_guardar_conductor()
// Guarda un conductor nuevo identificado solo por alias.
// No devuelve nada: redirige al panel con el resultado.
function tachoaviso_accion_guardar_conductor()
{
  $resultado = tachoaviso_guardar_conductor([
    'usuario_id' => tachoaviso_usuario_id(),
    'alias' => $_POST['alias'] ?? '',
    'vehiculo_id' => $_POST['vehiculo_id'] ?? 0,
  ]);

  if (is_wp_error($resultado)) {
    tachoaviso_volver('panel', 'error', $resultado->get_error_message());
  }

  tachoaviso_volver('panel', 'ok', 'Conductor guardado.');
}

// tachoaviso_accion_guardar_vencimiento()
// Calcula y guarda un vencimiento a partir de la fecha de referencia.
// No devuelve nada: redirige al panel con el resultado.
function tachoaviso_accion_guardar_vencimiento()
{
  $resultado = tachoaviso_guardar_vencimiento([
    'usuario_id' => tachoaviso_usuario_id(),
    'tipo' => $_POST['tipo'] ?? '',
    'fecha_referencia' => $_POST['fecha_referencia'] ?? '',
    'intervalo_dias' => $_POST['intervalo_dias'] ?? 0,
    'vehiculo_id' => $_POST['vehiculo_id'] ?? 0,
    'conductor_id' => $_POST['conductor_id'] ?? 0,
    'notas' => $_POST['notas'] ?? '',
  ]);

  if (is_wp_error($resultado)) {
    tachoaviso_volver('panel', 'error', $resultado->get_error_message());
  }

  tachoaviso_volver('panel', 'ok', 'Vencimiento calculado y guardado.');
}

// tachoaviso_accion_marcar_hecho()
// Cierra el ciclo actual y crea el siguiente vencimiento.
// No devuelve nada: redirige al panel con el resultado.
function tachoaviso_accion_marcar_hecho()
{
  $id = isset($_POST['vencimiento_id']) ? (int) $_POST['vencimiento_id'] : 0;
  $resultado = tachoaviso_marcar_hecho($id, tachoaviso_usuario_id());

  if (is_wp_error($resultado)) {
    tachoaviso_volver('panel', 'error', $resultado->get_error_message());
  }

  tachoaviso_volver('panel', 'ok', 'Trámite marcado como hecho. Ya está calculada la siguiente fecha.');
}

// tachoaviso_accion_guardar_ajustes()
// Guarda las antelaciones y el correo de avisos del usuario.
// No devuelve nada: redirige al panel con el resultado.
function tachoaviso_accion_guardar_ajustes()
{
  $antelaciones = [];

  foreach (['30', '15', '7'] as $dia) {
    if (isset($_POST['antelacion_' . $dia])) {
      $antelaciones[] = (int) $dia;
    }
  }

  tachoaviso_guardar_ajustes(tachoaviso_usuario_id(), [
    'antelaciones' => $antelaciones,
    'email_avisos' => $_POST['email_avisos'] ?? '',
    'recibir_avisos' => isset($_POST['recibir_avisos']),
  ]);

  tachoaviso_volver('panel', 'ok', 'Ajustes guardados.');
}

// tachoaviso_exportar_csv()
// Descarga los vencimientos del usuario en un CSV que Excel abre bien.
// No devuelve nada: envía las cabeceras y termina la ejecución.
function tachoaviso_exportar_csv()
{
  if (!tachoaviso_puede_gestionar()) {
    wp_die('No tienes permisos para exportar estos datos.');
  }

  check_admin_referer('tachoaviso_exportar');

  $filas = tachoaviso_vencimientos_con_estado(tachoaviso_usuario_id());
  $config = tachoaviso_config('csv');

  nocache_headers();
  header('Content-Type: text/csv; charset=' . $config['codificacion']);
  header('Content-Disposition: attachment; filename="' . $config['nombre'] . '"');

  $salida = fopen('php://output', 'w');

  // El BOM hace que Excel reconozca las tildes sin tocar la configuración.
  fwrite($salida, "\xEF\xBB\xBF");

  fputcsv($salida, [
    'Estado',
    'Matrícula',
    'Vehículo',
    'Conductor',
    'Trámite',
    'Fecha de referencia',
    'Fecha de vencimiento',
    'Días restantes',
    'Notas',
  ], $config['separador'], $config['delimitador']);

  foreach ($filas as $fila) {
    $plazo = tachoaviso_plazo($fila['tipo']);

    fputcsv($salida, [
      $fila['estado_texto'],
      $fila['matricula'],
      $fila['vehiculo_alias'],
      $fila['conductor_alias'],
      $plazo ? $plazo['etiqueta'] : $fila['tipo'],
      $fila['fecha_referencia'],
      $fila['fecha_vencimiento'],
      $fila['dias'],
      $fila['notas'],
    ], $config['separador'], $config['delimitador']);
  }

  fclose($salida);
  exit;
}
