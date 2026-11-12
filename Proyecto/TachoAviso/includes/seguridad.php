<?php
/**
 * Validación y protección de las peticiones.
 *
 * Cada formulario comprueba tres cosas: que el usuario ha iniciado sesión, que
 * el nonce es válido y que los datos tienen el formato esperado. La validación
 * del navegador ayuda, pero nunca sustituye a la del servidor.
 */

if (!defined('ABSPATH')) {
  exit;
}

// tachoaviso_usuario_id()
// Devuelve el ID del usuario conectado o 0 si no hay sesión.
// Se usa para aislar los datos de cada transportista.
function tachoaviso_usuario_id()
{
  return (int) get_current_user_id();
}

// tachoaviso_puede_gestionar()
// Comprueba que el usuario ha iniciado sesión y tiene el rol del plugin.
// Devuelve true o false, nunca redirige por su cuenta.
function tachoaviso_puede_gestionar()
{
  return is_user_logged_in() && current_user_can('manage_tachoaviso');
}

// tachoaviso_nonce($accion)
// Genera el token que demuestra que el formulario lo ha pintado WordPress.
// Devuelve el nonce listo para incluir en un campo oculto.
function tachoaviso_nonce($accion)
{
  return wp_create_nonce('tachoaviso_' . $accion);
}

// tachoaviso_nonce_valido($nonce, $accion)
// Comprueba el token recibido contra la acción esperada.
// Devuelve true si coincide y false si ha caducado o es falso.
function tachoaviso_nonce_valido($nonce, $accion)
{
  return (bool) wp_verify_nonce($nonce, 'tachoaviso_' . $accion);
}

// tachoaviso_limpiar($valor)
// Quita etiquetas y espacios sobrantes de un texto recibido por POST.
// Devuelve el texto limpio, nunca el original.
function tachoaviso_limpiar($valor)
{
  return sanitize_text_field(wp_unslash((string) $valor));
}

// tachoaviso_matricula_valida($matricula)
// Acepta matrículas españolas modernas (1234 ABC) y antiguas (AB 1234 CD).
// Devuelve true si el formato es correcto después de quitar guiones y espacios.
function tachoaviso_matricula_valida($matricula)
{
  $limpia = strtoupper(preg_replace('/[\s-]+/', '', (string) $matricula));

  if (preg_match('/^[0-9]{4}[A-Z]{3}$/', $limpia)) {
    return true;
  }

  return (bool) preg_match('/^[A-Z]{1,2}[0-9]{4}[A-Z]{0,2}$/', $limpia);
}

// tachoaviso_fecha_valida($fecha)
// Comprueba que el texto es una fecha real en formato Y-m-d.
// Devuelve true o false; no corrige automáticamente el valor.
function tachoaviso_fecha_valida($fecha)
{
  $objeto = DateTimeImmutable::createFromFormat('!Y-m-d', (string) $fecha);

  return $objeto && $objeto->format('Y-m-d') === (string) $fecha;
}

// tachoaviso_email_valido($email)
// Comprueba el correo con la función de WordPress.
// Devuelve true si se puede usar como destinatario de los avisos.
function tachoaviso_email_valido($email)
{
  return (bool) is_email((string) $email);
}

// tachoaviso_alias_valido($alias)
// Comprueba que el alias tiene entre 2 y 40 caracteres útiles.
// Devuelve true o false; el alias sustituye al nombre real del conductor.
function tachoaviso_alias_valido($alias)
{
  $limpio = trim((string) $alias);
  $longitud = function_exists('mb_strlen') ? mb_strlen($limpio) : strlen($limpio);

  return $longitud >= 2 && $longitud <= 40;
}
