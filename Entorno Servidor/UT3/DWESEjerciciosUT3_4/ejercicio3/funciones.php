<?php
// Ejercicio 3 (reto): funciones y datos comunes de la aplicación de alquiler.
//
// Las viviendas se guardan en la sesión de PHP porque el enunciado todavía no
// permite usar una base de datos. La sesión mantiene el array entre páginas.

// Si la sesión no está abierta, la abrimos. Tiene que ocurrir antes de que se
// escriba cualquier HTML, por eso este archivo se carga al principio.
if (!isset($_SESSION)) {
  session_start();
}

// tipos_vivienda()
// Devuelve los tipos de vivienda que se pueden elegir en el formulario.
function tipos_vivienda()
{
  return ['Piso', 'Adosado', 'Casa', 'Habitación', 'Chalé'];
}

// zonas()
// Devuelve las zonas que se pueden elegir en el formulario.
function zonas()
{
  return ['Centro', 'Sur', 'Norte', 'Este', 'Oeste'];
}

// extras_disponibles()
// Devuelve los extras que se pueden marcar en el formulario.
function extras_disponibles()
{
  return ['Piscina', 'Jardín', 'Garaje', 'Trastero'];
}

// fotos_disponibles()
// Devuelve un array con el nombre de cada foto y la descripción que se muestra.
function fotos_disponibles()
{
  return [
    'salon.svg' => 'Salón',
    'cocina.svg' => 'Cocina',
    'dormitorio.svg' => 'Dormitorio',
    'bano.svg' => 'Baño',
    'terraza.svg' => 'Terraza',
    'fachada.svg' => 'Fachada'
  ];
}

// viviendas()
// Devuelve el array de viviendas guardadas en la sesión.
// Si todavía no hay ninguna, devuelve un array vacío.
function viviendas()
{
  if (isset($_SESSION['viviendas'])) {
    return $_SESSION['viviendas'];
  }
  return [];
}

// borrador()
// Devuelve los datos que se guardaron al ir a elegir la foto.
// Si no hay borrador, devuelve null.
function borrador()
{
  if (isset($_SESSION['borrador'])) {
    return $_SESSION['borrador'];
  }
  return null;
}

// guardar_borrador($datos)
// Guarda en la sesión los datos del formulario para no perderlos al elegir foto.
// No devuelve nada.
function guardar_borrador($datos)
{
  $_SESSION['borrador'] = $datos;
}

// borrar_borrador()
// Vacía el borrador cuando la vivienda ya está guardada o se empieza de nuevo.
// No devuelve nada.
function borrar_borrador()
{
  unset($_SESSION['borrador']);
}

// guardar_vivienda($vivienda)
// Añade la vivienda al final del array de la sesión con un id nuevo.
// No devuelve nada.
function guardar_vivienda($vivienda)
{
  // El contador empieza en 0 la primera vez; después va sumando de uno en uno
  if (!isset($_SESSION['ultimo_id'])) {
    $_SESSION['ultimo_id'] = 0;
  }
  $_SESSION['ultimo_id']++;
  $vivienda['id'] = $_SESSION['ultimo_id'];

  if (!isset($_SESSION['viviendas'])) {
    $_SESSION['viviendas'] = [];
  }
  $_SESSION['viviendas'][] = $vivienda;
}

// borrar_vivienda($id)
// Copia todas las viviendas menos la que tiene ese id.
// No devuelve nada.
function borrar_vivienda($id)
{
  $quedan = [];
  foreach (viviendas() as $vivienda) {
    if ($vivienda['id'] != $id) {
      $quedan[] = $vivienda;
    }
  }
  $_SESSION['viviendas'] = $quedan;
}

// modificar_vivienda($id, $zona, $precio)
// Cambia la zona y el precio de la vivienda con ese id.
// No devuelve nada.
function modificar_vivienda($id, $zona, $precio)
{
  foreach ($_SESSION['viviendas'] as $indice => $vivienda) {
    if ($vivienda['id'] == $id) {
      $_SESSION['viviendas'][$indice]['zona'] = $zona;
      $_SESSION['viviendas'][$indice]['precio'] = $precio;
    }
  }
}

// buscar_vivienda($id)
// Devuelve la vivienda con ese id, o null si no existe.
function buscar_vivienda($id)
{
  foreach (viviendas() as $vivienda) {
    if ($vivienda['id'] == $id) {
      return $vivienda;
    }
  }
  return null;
}

// ordenar_por_zona($viviendas)
// Devuelve una copia del array ordenada por zona con el método de la burbuja.
// El array original no se toca.
function ordenar_por_zona($viviendas)
{
  $total = count($viviendas);
  for ($i = 0; $i < $total - 1; $i++) {
    for ($j = 0; $j < $total - 1 - $i; $j++) {
      // Si la zona de la izquierda va después alfabéticamente, se intercambian
      if ($viviendas[$j]['zona'] > $viviendas[$j + 1]['zona']) {
        $aux = $viviendas[$j];
        $viviendas[$j] = $viviendas[$j + 1];
        $viviendas[$j + 1] = $aux;
      }
    }
  }
  return $viviendas;
}

// filtrar_viviendas($viviendas, $precio_max, $dormitorios_min)
// Devuelve solo las viviendas que no pasan del precio máximo y llegan al
// mínimo de dormitorios. Si un filtro llega vacío, no se aplica.
function filtrar_viviendas($viviendas, $precio_max, $dormitorios_min)
{
  $resultado = [];
  foreach ($viviendas as $vivienda) {
    $vale = true;

    if ($precio_max != '' && is_numeric($precio_max) && $vivienda['precio'] > $precio_max) {
      $vale = false;
    }
    if ($dormitorios_min != '' && is_numeric($dormitorios_min) && $vivienda['dormitorios'] < $dormitorios_min) {
      $vale = false;
    }

    if ($vale) {
      $resultado[] = $vivienda;
    }
  }
  return $resultado;
}

// formatear_precio($precio)
// Devuelve el precio con dos decimales, punto de miles y el símbolo del euro.
function formatear_precio($precio)
{
  return number_format($precio, 2, ',', '.') . ' €';
}

// hora_par()
// Devuelve true si la hora actual es par y false si es impar.
function hora_par()
{
  return date('H') % 2 == 0;
}

// foto_elegida($datos)
// Devuelve el archivo de la foto elegida o la primera si no hay ninguna válida.
function foto_elegida($datos)
{
  $fotos = fotos_disponibles();
  if (isset($datos['foto']) && isset($fotos[$datos['foto']])) {
    return $datos['foto'];
  }
  // array_keys devuelve los nombres de las fotos; el primero es el de por defecto
  $nombres = array_keys($fotos);
  return $nombres[0];
}

// valor_campo($datos, $campo)
// Devuelve el valor de ese campo escapado, listo para imprimirlo en un input.
// Si el campo no existe, devuelve una cadena vacía.
function valor_campo($datos, $campo)
{
  if (isset($datos[$campo])) {
    return htmlspecialchars($datos[$campo]);
  }
  return '';
}

// seleccionado($datos, $campo, $valor)
// Devuelve el atributo selected si ese valor es el que está elegido.
function seleccionado($datos, $campo, $valor)
{
  if (isset($datos[$campo]) && $datos[$campo] == $valor) {
    return 'selected';
  }
  return '';
}

// marcado($datos, $extra)
// Devuelve el atributo checked si ese extra está marcado en el array.
function marcado($datos, $extra)
{
  if (isset($datos['extras']) && in_array($extra, $datos['extras'])) {
    return 'checked';
  }
  return '';
}

// validar_vivienda($datos)
// Comprueba los campos obligatorios y devuelve un array con los errores.
// Si no hay ningún error, devuelve un array vacío.
function validar_vivienda($datos)
{
  $errores = [];

  if (!isset($datos['tipo']) || !in_array($datos['tipo'], tipos_vivienda())) {
    $errores[] = 'Elige un tipo de vivienda válido.';
  }
  if (!isset($datos['zona']) || !in_array($datos['zona'], zonas())) {
    $errores[] = 'Elige una zona válida.';
  }
  if (!isset($datos['direccion']) || trim($datos['direccion']) == '') {
    $errores[] = 'Escribe la dirección.';
  }
  if (!isset($datos['dormitorios']) || !is_numeric($datos['dormitorios'])
    || $datos['dormitorios'] < 1 || $datos['dormitorios'] > 4) {
    $errores[] = 'El número de dormitorios tiene que estar entre 1 y 4.';
  }
  if (!isset($datos['precio']) || !is_numeric($datos['precio']) || $datos['precio'] <= 0) {
    $errores[] = 'El precio tiene que ser un número mayor que 0.';
  }

  return $errores;
}
