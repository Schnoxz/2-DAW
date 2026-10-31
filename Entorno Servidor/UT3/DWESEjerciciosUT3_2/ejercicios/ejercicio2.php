<?php
// Ejercicio 2 (opcional): varias operaciones con un array de 10 aleatorios.

// 1) y 2) Creo el array con valores entre 1 y 30 y lo enseño
$array = [];
for ($i = 0; $i < 10; $i++) {
  $array[] = rand(1, 30);
}

echo "<h2 class='h4 text-primary'>Ejercicio 2: operaciones con un array</h2>";
mostrarArray($array, '1) Array original');

// 3) y 4) La media es la suma de los valores (array_sum) entre cuántos hay (count)
$media = array_sum($array) / count($array);
echo "<p>3-4) Valor medio: <strong class='fs-5'>"
   . number_format($media, 2, ',', '.') . "</strong></p>";

// 5) Copio el array, lo ordeno de mayor a menor con rsort y me quedo con las tres primeras posiciones
$maximos = $array;
rsort($maximos);
mostrarArray(array_slice($maximos, 0, 3), '5) Tres valores máximos');

// 6) Lo mismo pero ordenando de menor a mayor con sort
$minimos = $array;
sort($minimos);
mostrarArray(array_slice($minimos, 0, 3), '6) Tres valores mínimos');

// 7) Copio el array y ordeno la copia: como los valores se copian, $array se queda como estaba
$arrayCopiado = $array;
sort($arrayCopiado);
mostrarArray($arrayCopiado, '7) $arrayCopiado ordenado con sort()');

// 8) array_splice quita el segundo elemento (posición 1) y vuelve a numerar el array, sin dejar huecos
array_splice($arrayCopiado, 1, 1);
mostrarArray($arrayCopiado, '8) $arrayCopiado sin el segundo elemento');
