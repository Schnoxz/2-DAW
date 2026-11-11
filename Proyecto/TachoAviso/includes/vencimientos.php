<?php
/**
 * Motor de fechas y semáforo.
 *
 * Es la pieza que no depende de WordPress: recibe una fecha, suma un plazo y
 * decide el color. Así se puede probar con fechas límite (fin de mes, año
 * bisiesto, plazo vencido) sin levantar la web entera.
 */

if (!defined('ABSPATH')) {
  exit;
}

// tachoaviso_hoy()
// Devuelve la fecha de hoy a medianoche en la zona horaria del negocio.
// Se usa como referencia para que todos los cálculos den los mismos días.
function tachoaviso_hoy()
{
  $zona = new DateTimeZone(tachoaviso_config('zona_horaria'));

  return new DateTimeImmutable('today', $zona);
}

// tachoaviso_fecha($valor)
// Convierte un texto Y-m-d o un objeto de fecha en un DateTimeImmutable.
// Devuelve null si el valor no representa una fecha real.
function tachoaviso_fecha($valor)
{
  if ($valor instanceof DateTimeImmutable) {
    return $valor;
  }

  $zona = new DateTimeZone(tachoaviso_config('zona_horaria'));
  $fecha = DateTimeImmutable::createFromFormat('!Y-m-d', (string) $valor, $zona);

  return $fecha ? $fecha : null;
}

// tachoaviso_calcular_vencimiento($fecha_referencia, $intervalo_dias)
// Suma el intervalo legal a la fecha de la última revisión.
// Devuelve la fecha en la que vuelve a tocar o null si los datos no son válidos.
function tachoaviso_calcular_vencimiento($fecha_referencia, $intervalo_dias)
{
  $inicio = tachoaviso_fecha($fecha_referencia);
  $dias = (int) $intervalo_dias;

  if (!$inicio || $dias < 1) {
    return null;
  }

  return $inicio->modify('+' . $dias . ' days');
}

// tachoaviso_dias_restantes($fecha_vencimiento, $hoy = null)
// Calcula los días que faltan desde hoy hasta el vencimiento.
// Devuelve un número negativo si ya ha vencido.
function tachoaviso_dias_restantes($fecha_vencimiento, $hoy = null)
{
  $fin = tachoaviso_fecha($fecha_vencimiento);
  $referencia = $hoy ? tachoaviso_fecha($hoy) : tachoaviso_hoy();

  if (!$fin || !$referencia) {
    return null;
  }

  return (int) $referencia->diff($fin)->format('%r%a');
}

// tachoaviso_estado_semaforo($dias)
// Clasifica los días restantes en verde, ambar o rojo.
// Un vencimiento ya pasado siempre es rojo, aunque el plazo sea largo.
function tachoaviso_estado_semaforo($dias)
{
  if ($dias === null) {
    return 'desconocido';
  }

  $semaforo = tachoaviso_config('semaforo');

  if ($dias < 0 || $dias <= $semaforo['rojo_hasta']) {
    return 'rojo';
  }

  if ($dias < $semaforo['verde_desde']) {
    return 'ambar';
  }

  return 'verde';
}

// tachoaviso_texto_estado($dias)
// Traduce los días restantes a una frase corta para el panel y el correo.
// Devuelve el texto ya en español, sin abreviaturas.
function tachoaviso_texto_estado($dias)
{
  if ($dias === null) {
    return 'Sin fecha';
  }

  if ($dias < 0) {
    $pasados = abs($dias);

    return 'Vencido hace ' . $pasados . ($pasados === 1 ? ' día' : ' días');
  }

  if ($dias === 0) {
    return 'Vence hoy';
  }

  if ($dias === 1) {
    return 'Vence mañana';
  }

  return 'Quedan ' . $dias . ' días';
}

// tachoaviso_ordenar_por_urgencia($filas)
// Ordena una lista de vencimientos por días restantes, lo más urgente primero.
// Devuelve una lista nueva: no modifica la que recibe.
function tachoaviso_ordenar_por_urgencia($filas)
{
  usort($filas, function ($a, $b) {
    $dias_a = isset($a['dias']) ? (int) $a['dias'] : PHP_INT_MAX;
    $dias_b = isset($b['dias']) ? (int) $b['dias'] : PHP_INT_MAX;

    return $dias_a <=> $dias_b;
  });

  return $filas;
}

// tachoaviso_resumen($filas)
// Cuenta cuántos vencimientos hay en cada color y cuántos están vencidos.
// Devuelve un array con total, rojo, ambar, verde y vencidos.
function tachoaviso_resumen($filas)
{
  $resumen = [
    'total' => count($filas),
    'rojo' => 0,
    'ambar' => 0,
    'verde' => 0,
    'vencidos' => 0,
  ];

  foreach ($filas as $fila) {
    $estado = isset($fila['estado']) ? $fila['estado'] : tachoaviso_estado_semaforo(null);

    if (isset($resumen[$estado])) {
      $resumen[$estado]++;
    }

    if (isset($fila['dias']) && $fila['dias'] < 0) {
      $resumen['vencidos']++;
    }
  }

  return $resumen;
}

// tachoaviso_completar_filas($filas, $hoy = null)
// Añade a cada vencimiento los días restantes, el estado y el texto.
// Devuelve la lista ya preparada para pintar la tabla.
function tachoaviso_completar_filas($filas, $hoy = null)
{
  $resultado = [];

  foreach ($filas as $fila) {
    $dias = tachoaviso_dias_restantes($fila['fecha_vencimiento'], $hoy);
    $fila['dias'] = $dias;
    $fila['estado'] = tachoaviso_estado_semaforo($dias);
    $fila['estado_texto'] = tachoaviso_texto_estado($dias);
    $resultado[] = $fila;
  }

  return $resultado;
}
