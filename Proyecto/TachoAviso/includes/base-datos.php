<?php
/**
 * Acceso a datos con $wpdb.
 *
 * Todas las consultas filtran por usuario_id: un transportista nunca puede ver
 * los vehículos, los conductores ni los vencimientos de otro. Las escrituras
 * usan $wpdb->insert y $wpdb->update, que preparan los valores solos.
 */

if (!defined('ABSPATH')) {
  exit;
}

// tachoaviso_tabla($nombre)
// Devuelve el nombre real de una tabla con el prefijo de WordPress.
// Solo admite los cuatro nombres del plugin para no concatenar texto libre.
function tachoaviso_tabla($nombre)
{
  global $wpdb;

  $permitidas = ['vehiculos', 'conductores', 'vencimientos', 'avisos'];

  if (!in_array($nombre, $permitidas, true)) {
    return '';
  }

  return $wpdb->prefix . 'ta_' . $nombre;
}

// tachoaviso_obtener_vehiculos($usuario_id)
// Recupera los vehículos activos de un usuario ordenados por matrícula.
// Devuelve una lista de arrays asociativos; vacía si no tiene ninguno.
function tachoaviso_obtener_vehiculos($usuario_id)
{
  global $wpdb;

  $tabla = tachoaviso_tabla('vehiculos');
  $sql = "SELECT * FROM {$tabla} WHERE usuario_id = %d AND activo = 1 ORDER BY matricula ASC";

  return $wpdb->get_results($wpdb->prepare($sql, (int) $usuario_id), ARRAY_A);
}

// tachoaviso_obtener_conductores($usuario_id)
// Recupera los conductores activos de un usuario ordenados por alias.
// Devuelve una lista de arrays asociativos; el alias es el único nombre visible.
function tachoaviso_obtener_conductores($usuario_id)
{
  global $wpdb;

  $tabla = tachoaviso_tabla('conductores');
  $sql = "SELECT * FROM {$tabla} WHERE usuario_id = %d AND activo = 1 ORDER BY alias ASC";

  return $wpdb->get_results($wpdb->prepare($sql, (int) $usuario_id), ARRAY_A);
}

// tachoaviso_obtener_vencimientos($usuario_id)
// Recupera los vencimientos activos con la matrícula y los alias ya resueltos.
// Devuelve las filas sin calcular; los días y el color se añaden después.
function tachoaviso_obtener_vencimientos($usuario_id)
{
  global $wpdb;

  $vencimientos = tachoaviso_tabla('vencimientos');
  $vehiculos = tachoaviso_tabla('vehiculos');
  $conductores = tachoaviso_tabla('conductores');

  $sql = "SELECT v.*, ve.matricula, ve.alias AS vehiculo_alias, c.alias AS conductor_alias
    FROM {$vencimientos} v
    LEFT JOIN {$vehiculos} ve ON ve.id = v.vehiculo_id
    LEFT JOIN {$conductores} c ON c.id = v.conductor_id
    WHERE v.usuario_id = %d AND v.activo = 1
    ORDER BY v.fecha_vencimiento ASC";

  return $wpdb->get_results($wpdb->prepare($sql, (int) $usuario_id), ARRAY_A);
}

// tachoaviso_vencimientos_con_estado($usuario_id, $hoy = null)
// Añade días restantes, color y texto a cada vencimiento y los ordena.
// Devuelve la lista lista para pintar el panel.
function tachoaviso_vencimientos_con_estado($usuario_id, $hoy = null)
{
  $filas = tachoaviso_obtener_vencimientos($usuario_id);
  $filas = tachoaviso_completar_filas($filas, $hoy);

  return tachoaviso_ordenar_por_urgencia($filas);
}

// tachoaviso_vencimientos_todos()
// Recupera los vencimientos de todos los usuarios junto con su correo.
// Solo se usa desde la tarea programada que envía los avisos.
function tachoaviso_vencimientos_todos()
{
  global $wpdb;

  $vencimientos = tachoaviso_tabla('vencimientos');
  $vehiculos = tachoaviso_tabla('vehiculos');
  $conductores = tachoaviso_tabla('conductores');

  $sql = "SELECT v.*, ve.matricula, ve.alias AS vehiculo_alias, c.alias AS conductor_alias,
      u.user_email, u.display_name
    FROM {$vencimientos} v
    INNER JOIN {$wpdb->users} u ON u.ID = v.usuario_id
    LEFT JOIN {$vehiculos} ve ON ve.id = v.vehiculo_id
    LEFT JOIN {$conductores} c ON c.id = v.conductor_id
    WHERE v.activo = 1
    ORDER BY v.fecha_vencimiento ASC";

  return $wpdb->get_results($sql, ARRAY_A);
}

// tachoaviso_contar_vehiculos($usuario_id)
// Cuenta los vehículos activos para comprobar el límite del plan.
// Devuelve el número entero de vehículos.
function tachoaviso_contar_vehiculos($usuario_id)
{
  global $wpdb;

  $tabla = tachoaviso_tabla('vehiculos');
  $sql = "SELECT COUNT(*) FROM {$tabla} WHERE usuario_id = %d AND activo = 1";

  return (int) $wpdb->get_var($wpdb->prepare($sql, (int) $usuario_id));
}

// tachoaviso_guardar_vehiculo($datos)
// Valida y guarda un vehículo del usuario conectado.
// Devuelve el ID guardado o un WP_Error con el motivo del fallo.
function tachoaviso_guardar_vehiculo($datos)
{
  global $wpdb;

  $usuario_id = isset($datos['usuario_id']) ? (int) $datos['usuario_id'] : tachoaviso_usuario_id();
  $matricula = isset($datos['matricula']) ? strtoupper(tachoaviso_limpiar($datos['matricula'])) : '';
  $alias = isset($datos['alias']) ? tachoaviso_limpiar($datos['alias']) : '';
  $marca = isset($datos['marca']) ? tachoaviso_limpiar($datos['marca']) : '';

  if ($usuario_id < 1 || !tachoaviso_puede_gestionar()) {
    return new WP_Error('sin_permiso', 'No tienes permisos para guardar vehículos.');
  }

  if (!tachoaviso_matricula_valida($matricula)) {
    return new WP_Error('matricula', 'La matrícula no tiene un formato válido.');
  }

  if ($alias === '') {
    $alias = $matricula;
  }

  if (!tachoaviso_alias_valido($alias)) {
    return new WP_Error('alias', 'El alias debe tener entre 2 y 40 caracteres.');
  }

  $tabla = tachoaviso_tabla('vehiculos');
  $existe = $wpdb->get_var($wpdb->prepare(
    "SELECT id FROM {$tabla} WHERE usuario_id = %d AND matricula = %s AND activo = 1",
    $usuario_id,
    $matricula
  ));

  if ($existe) {
    return new WP_Error('duplicado', 'Ese vehículo ya está dado de alta.');
  }

  $insertado = $wpdb->insert(
    $tabla,
    [
      'usuario_id' => $usuario_id,
      'matricula' => $matricula,
      'alias' => $alias,
      'marca' => $marca,
      'activo' => 1,
    ],
    ['%d', '%s', '%s', '%s', '%d']
  );

  if (!$insertado) {
    return new WP_Error('base_datos', 'No se ha podido guardar el vehículo.');
  }

  return (int) $wpdb->insert_id;
}

// tachoaviso_guardar_conductor($datos)
// Valida y guarda un conductor identificado solo por alias.
// Devuelve el ID guardado o un WP_Error con el motivo del fallo.
function tachoaviso_guardar_conductor($datos)
{
  global $wpdb;

  $usuario_id = isset($datos['usuario_id']) ? (int) $datos['usuario_id'] : tachoaviso_usuario_id();
  $alias = isset($datos['alias']) ? tachoaviso_limpiar($datos['alias']) : '';
  $vehiculo_id = isset($datos['vehiculo_id']) ? (int) $datos['vehiculo_id'] : 0;

  if ($usuario_id < 1 || !tachoaviso_puede_gestionar()) {
    return new WP_Error('sin_permiso', 'No tienes permisos para guardar conductores.');
  }

  if (!tachoaviso_alias_valido($alias)) {
    return new WP_Error('alias', 'El alias debe tener entre 2 y 40 caracteres.');
  }

  $tabla = tachoaviso_tabla('conductores');
  $insertado = $wpdb->insert(
    $tabla,
    [
      'usuario_id' => $usuario_id,
      'vehiculo_id' => $vehiculo_id > 0 ? $vehiculo_id : null,
      'alias' => $alias,
      'activo' => 1,
    ],
    ['%d', '%d', '%s', '%d']
  );

  if (!$insertado) {
    return new WP_Error('base_datos', 'No se ha podido guardar el conductor.');
  }

  return (int) $wpdb->insert_id;
}

// tachoaviso_guardar_vencimiento($datos)
// Calcula la fecha de vencimiento a partir de la referencia y el intervalo.
// Devuelve el ID guardado o un WP_Error si el trámite o la fecha no son válidos.
function tachoaviso_guardar_vencimiento($datos)
{
  global $wpdb;

  $usuario_id = isset($datos['usuario_id']) ? (int) $datos['usuario_id'] : tachoaviso_usuario_id();
  $tipo = isset($datos['tipo']) ? tachoaviso_limpiar($datos['tipo']) : '';
  $fecha_referencia = isset($datos['fecha_referencia']) ? tachoaviso_limpiar($datos['fecha_referencia']) : '';
  $intervalo = isset($datos['intervalo_dias']) ? (int) $datos['intervalo_dias'] : 0;
  $vehiculo_id = isset($datos['vehiculo_id']) ? (int) $datos['vehiculo_id'] : 0;
  $conductor_id = isset($datos['conductor_id']) ? (int) $datos['conductor_id'] : 0;
  $notas = isset($datos['notas']) ? tachoaviso_limpiar($datos['notas']) : '';

  if ($usuario_id < 1 || !tachoaviso_puede_gestionar()) {
    return new WP_Error('sin_permiso', 'No tienes permisos para guardar vencimientos.');
  }

  $plazo = tachoaviso_plazo($tipo);

  if (!$plazo) {
    return new WP_Error('tipo', 'El tipo de trámite no existe.');
  }

  if ($intervalo < 1) {
    $intervalo = (int) $plazo['dias'];
  }

  if (!tachoaviso_fecha_valida($fecha_referencia)) {
    return new WP_Error('fecha', 'La fecha de referencia no es válida.');
  }

  $vencimiento = tachoaviso_calcular_vencimiento($fecha_referencia, $intervalo);

  if (!$vencimiento) {
    return new WP_Error('calculo', 'No se ha podido calcular el vencimiento.');
  }

  $tabla = tachoaviso_tabla('vencimientos');
  $insertado = $wpdb->insert(
    $tabla,
    [
      'usuario_id' => $usuario_id,
      'vehiculo_id' => $vehiculo_id > 0 ? $vehiculo_id : null,
      'conductor_id' => $conductor_id > 0 ? $conductor_id : null,
      'tipo' => $tipo,
      'fecha_referencia' => $fecha_referencia,
      'intervalo_dias' => $intervalo,
      'fecha_vencimiento' => $vencimiento->format('Y-m-d'),
      'notas' => $notas,
      'activo' => 1,
    ],
    ['%d', '%d', '%d', '%s', '%s', '%d', '%s', '%s', '%d']
  );

  if (!$insertado) {
    return new WP_Error('base_datos', 'No se ha podido guardar el vencimiento.');
  }

  return (int) $wpdb->insert_id;
}

// tachoaviso_marcar_hecho($vencimiento_id, $usuario_id)
// Cierra el ciclo actual y crea el siguiente con la fecha de hoy como referencia.
// Devuelve el ID del nuevo vencimiento o un WP_Error si no existe.
function tachoaviso_marcar_hecho($vencimiento_id, $usuario_id)
{
  global $wpdb;

  $tabla = tachoaviso_tabla('vencimientos');
  $fila = $wpdb->get_row($wpdb->prepare(
    "SELECT * FROM {$tabla} WHERE id = %d AND usuario_id = %d AND activo = 1",
    (int) $vencimiento_id,
    (int) $usuario_id
  ), ARRAY_A);

  if (!$fila) {
    return new WP_Error('no_existe', 'El vencimiento no existe o no es tuyo.');
  }

  $hoy = tachoaviso_hoy()->format('Y-m-d');
  $nuevo = tachoaviso_calcular_vencimiento($hoy, (int) $fila['intervalo_dias']);

  if (!$nuevo) {
    return new WP_Error('calculo', 'No se ha podido calcular el siguiente vencimiento.');
  }

  $insertado = $wpdb->insert(
    $tabla,
    [
      'usuario_id' => (int) $usuario_id,
      'vehiculo_id' => $fila['vehiculo_id'],
      'conductor_id' => $fila['conductor_id'],
      'tipo' => $fila['tipo'],
      'fecha_referencia' => $hoy,
      'intervalo_dias' => (int) $fila['intervalo_dias'],
      'fecha_vencimiento' => $nuevo->format('Y-m-d'),
      'notas' => $fila['notas'],
      'activo' => 1,
    ],
    ['%d', '%d', '%d', '%s', '%s', '%d', '%s', '%s', '%d']
  );

  if (!$insertado) {
    return new WP_Error('base_datos', 'No se ha podido crear el siguiente vencimiento.');
  }

  // El ciclo anterior se conserva desactivado: sirve de historial.
  $wpdb->update($tabla, ['activo' => 0], ['id' => (int) $vencimiento_id], ['%d'], ['%d']);

  return (int) $wpdb->insert_id;
}

// tachoaviso_ajustes_usuario($usuario_id)
// Lee las preferencias de aviso y las mezcla con los valores por defecto.
// Devuelve un array con antelaciones, correo y si recibe avisos.
function tachoaviso_ajustes_usuario($usuario_id)
{
  $defecto = [
    'antelaciones' => tachoaviso_antelaciones(),
    'email_avisos' => '',
    'recibir_avisos' => 1,
  ];

  $guardados = get_user_meta((int) $usuario_id, 'tachoaviso_ajustes', true);

  if (!is_array($guardados)) {
    return $defecto;
  }

  return array_merge($defecto, $guardados);
}

// tachoaviso_guardar_ajustes($usuario_id, $datos)
// Guarda las preferencias del usuario en su metadato.
// Devuelve true si WordPress ha actualizado el valor.
function tachoaviso_guardar_ajustes($usuario_id, $datos)
{
  $antelaciones = isset($datos['antelaciones']) && is_array($datos['antelaciones']) ? $datos['antelaciones'] : [7, 15, 30];
  $limpias = [];

  foreach ($antelaciones as $dia) {
    $dia = (int) $dia;

    if ($dia >= 1 && $dia <= 90) {
      $limpias[] = $dia;
    }
  }

  sort($limpias, SORT_NUMERIC);

  $ajustes = [
    'antelaciones' => array_values(array_unique($limpias)),
    'email_avisos' => isset($datos['email_avisos']) ? tachoaviso_limpiar($datos['email_avisos']) : '',
    'recibir_avisos' => isset($datos['recibir_avisos']) ? 1 : 0,
  ];

  return update_user_meta((int) $usuario_id, 'tachoaviso_ajustes', $ajustes);
}

// tachoaviso_antelaciones_usuario($usuario_id)
// Devuelve las antelaciones configuradas por el usuario, ya ordenadas.
// Si no ha configurado ninguna, devuelve las del sistema.
function tachoaviso_antelaciones_usuario($usuario_id)
{
  $ajustes = tachoaviso_ajustes_usuario($usuario_id);
  $dias = $ajustes['antelaciones'];

  if (!is_array($dias) || count($dias) === 0) {
    $dias = tachoaviso_antelaciones();
  }

  sort($dias, SORT_NUMERIC);

  return $dias;
}

// tachoaviso_aviso_enviado($vencimiento_id, $dias_antelacion)
// Comprueba si ya se envió ese aviso para ese vencimiento.
// Devuelve true si existe, para no mandar el mismo correo dos veces.
function tachoaviso_aviso_enviado($vencimiento_id, $dias_antelacion)
{
  global $wpdb;

  $tabla = tachoaviso_tabla('avisos');
  $sql = "SELECT id FROM {$tabla} WHERE vencimiento_id = %d AND dias_antelacion = %d LIMIT 1";

  return (bool) $wpdb->get_var($wpdb->prepare($sql, (int) $vencimiento_id, (int) $dias_antelacion));
}

// tachoaviso_crear_aviso($vencimiento_id, $dias_antelacion, $estado)
// Deja constancia del aviso enviado para no repetirlo en la siguiente pasada.
// Devuelve el ID del registro o 0 si no se ha podido guardar.
function tachoaviso_crear_aviso($vencimiento_id, $dias_antelacion, $estado = 'enviado')
{
  global $wpdb;

  $tabla = tachoaviso_tabla('avisos');
  $insertado = $wpdb->insert(
    $tabla,
    [
      'vencimiento_id' => (int) $vencimiento_id,
      'dias_antelacion' => (int) $dias_antelacion,
      'estado' => $estado,
    ],
    ['%d', '%d', '%s']
  );

  return $insertado ? (int) $wpdb->insert_id : 0;
}
