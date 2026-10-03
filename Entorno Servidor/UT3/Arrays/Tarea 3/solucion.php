<?php

$suma = 0;
for ($i = 1; $i <= 100; $i++) {
    $suma += $i;
}
echo "La suma de los números del 1 al 100 es: $suma<br>";

$frutas = ['fresa', 'naranja', 'uva'];
$colores = ['rojo', 'verde'];

$vueltasExterior = 0;
$vueltasInterior = 0;
$echos = 0;

foreach ($frutas as $fruta) {
    $vueltasExterior++;
    foreach ($colores as $color) {
        $vueltasInterior++;
        $echos++;
        echo "La $fruta es $color<br>";
    }
}

echo "<hr>";
echo "Primer foreach: $vueltasExterior veces<br>";
echo "Segundo foreach: $vueltasInterior veces<br>";
echo "echo realizados: $echos<br>";