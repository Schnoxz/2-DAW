<?php
// Ejercicio 3: la media de los valores de un array.

echo "<h2 class='h4 text-primary'>Ejercicio 3: media de un array</h2>";

// Notas de ejemplo; la función sirve para cualquier array de números
$notas = [6, 4, 8, 5, 7, 9];
mostrar_array($notas, 'Notas');

echo "<p>La media de las " . count($notas) . " notas es <strong>"
  . round(calcular_media($notas), 2) . "</strong>.</p>";
