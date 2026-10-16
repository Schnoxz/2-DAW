<?php
// Ejercicio 7 (obligatorio): contar frutas.

echo "<h2 class='h4 text-primary'>Ejercicio 7: contar frutas (obligatorio)</h2>";

// Entre 7 y 20 frutas. Los codigos Unicode de las frutas van del 127815 al 127827.
$totalFrutas = rand(7, 20);

$frutas = [];
for ($i = 0; $i < $totalFrutas; $i++) {
  $frutas[] = rand(127815, 127827);
}

// Saco una de las que han salido, para contarla despues
$posicionElegida = array_rand($frutas);
$frutaElegida = $frutas[$posicionElegida];

// Y recorro el array contando cuantas veces aparece
$veces = 0;
foreach ($frutas as $fruta) {
  if ($fruta == $frutaElegida) {
    $veces++;
  }
}
?>
<h3 class="h5">Frutas que han salido (<?= $totalFrutas ?>)</h3>
<!-- todas las que han salido, en grande -->
<p class="fs-2 mb-4">
  <?php foreach ($frutas as $fruta): ?>&#<?= $fruta ?>; <?php endforeach; ?>
</p>

<hr>

<p class="fs-4">
  La fruta <span class="fs-1">&#<?= $frutaElegida ?>;</span>
  aparece <strong><?= $veces ?></strong> <?= ($veces == 1 ? 'vez' : 'veces') ?>.
</p>
