<?php
// Ejercicio 4 (opcional): ordenar un array asociativo de cuatro maneras.

// Array de precios: la clave es la fruta y el valor su precio
$precios = [
  'manzana' => 1.20,
  'pera'    => 0.95,
  'plátano' => 0.60,
  'naranja' => 1.10,
  'uva'     => 2.40,
  'melón'   => 1.75,
];

// asort, arsort, ksort y krsort cambian el array que reciben, así que ordeno una copia de cada uno
$porValorAsc = $precios;
asort($porValorAsc);      // de menor a mayor por valor

$porClaveAsc = $precios;
ksort($porClaveAsc);      // de menor a mayor por clave (alfabéticamente)

$porValorDesc = $precios;
arsort($porValorDesc);    // de mayor a menor por valor

$porClaveDesc = $precios;
krsort($porClaveDesc);    // de mayor a menor por clave

echo "<h2 class='h4 text-primary'>Ejercicio 4: ordenar un array asociativo</h2>";
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
