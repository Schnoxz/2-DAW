<?php
// Ejercicio 5: el valor mínimo de un array.

echo "<h2 class='h4 text-primary'>Ejercicio 5: valor mínimo de un array</h2>";

// Todos los valores son positivos: el mínimo es 4, no 0
$precios = [15, 9, 4, 27, 11];
mostrar_array($precios, 'Precios');

echo "<p>El precio más bajo es <strong>" . calcular_minimo($precios) . "</strong>.</p>";
