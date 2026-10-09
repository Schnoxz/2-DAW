<?php
// ================= EJERCICIO 7 (OBLIGATORIO): contar frutas =================
// Trozo de pagina que index.php incluye dentro de la pestaña del ejercicio 7.

echo "<h2 class='h4 text-primary'>Ejercicio 7: contar frutas (obligatorio)</h2>";

// 1) Elijo al azar cuantas frutas voy a mostrar, entre 7 y 20
$totalFrutas = rand(7, 20);

// 2) Relleno un array con esa cantidad de frutas al azar.
//    Cada fruta es un codigo Unicode entre 127815 ( ) y 127827 ( ).
$frutas = [];
for ($i = 0; $i < $totalFrutas; $i++) {
  $frutas[] = rand(127815, 127827);
}

// 3) Elijo una fruta al azar de las que han salido, para luego contarla.
//    array_rand() devuelve una posicion al azar del array.
$posicionElegida = array_rand($frutas);
$frutaElegida = $frutas[$posicionElegida];

// 4) Cuento cuantas veces aparece esa fruta recorriendo el array con un foreach.
$veces = 0;
foreach ($frutas as $fruta) {
  if ($fruta == $frutaElegida) {
    $veces++;
  }
}
?>
<h3 class="h5">Frutas que han salido (<?= $totalFrutas ?>)</h3>
<!-- Muestro todas las frutas grandes. &#<?= $fruta ?>; es como escribir &#127815; -->
<p class="fs-2 mb-4">
  <?php foreach ($frutas as $fruta): ?>&#<?= $fruta ?>; <?php endforeach; ?>
</p>

<hr>

<!-- Frase final: solo cambian la imagen de la fruta y el numero de veces -->
<p class="fs-4">
  La fruta <span class="fs-1">&#<?= $frutaElegida ?>;</span>
  aparece <strong><?= $veces ?></strong> <?= ($veces == 1 ? 'vez' : 'veces') ?>.
</p>
