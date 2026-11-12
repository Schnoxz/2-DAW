<?php
// Ejercicio 6: imprimir un array en una tabla de dos columnas.

echo "<h2 class='h4 text-primary'>Ejercicio 6: array en tabla de posición y valor</h2>";

$frutas = ['manzana', 'pera', 'plátano', 'uva', 'naranja'];
imprimir_array($frutas);

echo "<p class='text-secondary small mb-0'>La primera columna es la posición que "
  . "ocupa cada elemento dentro del array, no un número que hayamos puesto nosotros.</p>";
