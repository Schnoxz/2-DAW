<?php
// Ejercicio 7 (obligatorio): contar cuántas veces aparece una fruta
// Todo ocurre en una sola página: al cargar se generan las frutas y se cuenta

echo "<h2 class='h4 text-primary'>Ejercicio 7: contar frutas (obligatorio)</h2>";

// Entre 7 y 20 frutas, al azar
$totalFrutas = rand(7, 20);

// Las frutas son emojis: sus códigos Unicode van del 127815 al 127827
// Guardo solo el número de cada fruta y luego lo escribo como &#número;
$frutas = [];
for ($i = 0; $i < $totalFrutas; $i++) {
  $frutas[] = rand(127815, 127827);
}

// array_rand devuelve una posición al azar del array: así la fruta que se busca es una de las que han salido
$posicionElegida = array_rand($frutas);
$frutaElegida = $frutas[$posicionElegida];

// Recorro el array y cuento cuántas veces coincide con la elegida
$veces = 0;
foreach ($frutas as $fruta) {
  if ($fruta == $frutaElegida) {
    $veces++;
  }
}
?>
<h3 class="h5">Frutas que han salido (<?= $totalFrutas ?>)</h3>
<!-- Todas las frutas generadas, en tamaño grande -->
<p class="fs-2 mb-4">
  <?php foreach ($frutas as $fruta): ?>&#<?= $fruta ?>; <?php endforeach; ?>
</p>

<hr>

<!-- Frase final: solo cambian el dibujo de la fruta y el número de veces -->
<p class="fs-4">
  La fruta <span class="fs-1">&#<?= $frutaElegida ?>;</span>
  aparece <strong><?= $veces ?></strong> <?= ($veces == 1 ? 'vez' : 'veces') ?>.
</p>
