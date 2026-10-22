<?php
// Ejercicio 2 (opcional): varias operaciones con un array de 10 aleatorios.

require_once __DIR__ . '/helpers.php';

// 1) y 2) Creo el array con valores entre 1 y 30 y lo enseño
$array = [];
for ($i = 0; $i < 10; $i++) {
    $array[] = rand(1, 30);
}

echo '<h2 class="h4 text-primary">Ejercicio 2: operaciones con un array</h2>';
mostrarArray($array, '1) Array original');

// 3) y 4) Media: suma de todos los valores (array_sum) entre cuántos hay (count).
// number_format la muestra con dos decimales y coma decimal.
$media = array_sum($array) / count($array);
echo '<p>3-4) Valor medio: <strong class="fs-5">'
   . number_format($media, 2, ',', '.') . '</strong></p>';

// 5) Tres máximos: copio el array, lo ordeno de mayor a menor con rsort y me
// quedo con las tres primeras posiciones con array_slice.
$copiaParaMaximos = $array;
rsort($copiaParaMaximos);
$maximos = array_slice($copiaParaMaximos, 0, 3);
mostrarArray($maximos, '5) Tres valores máximos');

// 6) Tres mínimos: lo mismo pero ordenando de menor a mayor con sort
$copiaParaMinimos = $array;
sort($copiaParaMinimos);
$minimos = array_slice($copiaParaMinimos, 0, 3);
mostrarArray($minimos, '6) Tres valores mínimos');

// 7) Copia ordenada. Al asignar, PHP copia los valores, así que $array se
// queda como estaba y puedo ordenar la copia sin miedo.
$arrayCopiado = $array;
sort($arrayCopiado);
mostrarArray($arrayCopiado, '7) $arrayCopiado ordenado con sort()');

// 8) Quito el segundo elemento, que está en la posición 1 (las posiciones
// empiezan en 0). array_splice lo elimina y vuelve a numerar el array, para
// que no quede un hueco en las claves.
array_splice($arrayCopiado, 1, 1);
mostrarArray($arrayCopiado, '8) $arrayCopiado sin el segundo elemento');
