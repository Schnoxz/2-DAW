<?php
// Práctica guiada UT3 - Librería de funciones
// Conductor: Javier Jiménez Alonso | Navegante: pendiente de confirmar compañero/a
// Aquí solo van las funciones: este fichero no imprime nada.

// aplicarDescuento(&$precios, $porcentaje = 10)
// Recibe un array de precios por referencia y un porcentaje (10 por defecto).
// Resta a cada precio ese porcentaje. No devuelve nada: modifica el array original.
function aplicarDescuento(&$precios, $porcentaje = 10)
{
  // El & del foreach hace que $precio sea el valor real del array,
  // no una copia; sin él, la rebaja se perdería al salir del bucle.
  foreach ($precios as &$precio) {
    $precio = $precio - ($precio * $porcentaje / 100);
  }
  // Al terminar con referencia hay que romperla, o el último $precio
  // seguiría apuntando al último elemento del array.
  unset($precio);
}

// calcularIvaGeneral($importe)
// Devuelve el importe con el 21 % de IVA añadido.
function calcularIvaGeneral($importe)
{
  return $importe * 1.21;
}

// calcularIvaReducido($importe)
// Devuelve el importe con el 10 % de IVA añadido.
function calcularIvaReducido($importe)
{
  return $importe * 1.10;
}

// procesarFactura($funcionIva, $importe)
// Recibe el nombre de una función de IVA y un importe.
// Devuelve el resultado de aplicar esa función al importe.
function procesarFactura($funcionIva, $importe)
{
  // Los paréntesis ejecutan la función cuyo nombre llega en $funcionIva.
  return $funcionIva($importe);
}
