<?php
// Ejercicio 4 (opcional): ordenar un array asociativo de cuatro maneras.
//   asort()  -> de menor a mayor por valor
//   arsort() -> de mayor a menor por valor
//   ksort()  -> de menor a mayor por clave (alfabéticamente)
//   krsort() -> de mayor a menor por clave
// Estas funciones cambian el array que reciben, así que llamo a cada una
// sobre una copia para no perder el orden original.

require_once __DIR__ . '/helpers.php';

// Array de precios: la clave es la fruta y el valor su precio
$precios = [
    'manzana' => 1.20,
    'pera'    => 0.95,
    'plátano' => 0.60,
    'naranja' => 1.10,
    'uva'     => 2.40,
    'melón'   => 1.75,
];

// Una copia por cada ordenación
$porValorAsc = $precios;
asort($porValorAsc);

$porClaveAsc = $precios;
ksort($porClaveAsc);

$porValorDesc = $precios;
arsort($porValorDesc);

$porClaveDesc = $precios;
krsort($porClaveDesc);

echo '<h2 class="h4 text-primary">Ejercicio 4: ordenar un array asociativo</h2>';
mostrarAsociativo($precios, 'Array original (sin ordenar)');
?>

<!-- row y col-md-6: dos tarjetas por fila en pantallas medianas o grandes -->
<div class="row g-3">
  <div class="col-md-6">
    <div class="card h-100">
      <div class="card-header">asort() · ascendente por valor</div>
      <div class="card-body"><?php mostrarAsociativo($porValorAsc); ?></div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card h-100">
      <div class="card-header">ksort() · ascendente por clave</div>
      <div class="card-body"><?php mostrarAsociativo($porClaveAsc); ?></div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card h-100">
      <div class="card-header">arsort() · descendente por valor</div>
      <div class="card-body"><?php mostrarAsociativo($porValorDesc); ?></div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card h-100">
      <div class="card-header">krsort() · descendente por clave</div>
      <div class="card-body"><?php mostrarAsociativo($porClaveDesc); ?></div>
    </div>
  </div>
</div>
