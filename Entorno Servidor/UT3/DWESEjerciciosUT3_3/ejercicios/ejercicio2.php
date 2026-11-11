<?php
// Ejercicio 2: crear el array con una función y mostrarlo con otra.

echo "<h2 class='h4 text-primary'>Ejercicio 2: inicializar y mostrar un array</h2>";

// Los tres datos son parámetros: cuántos elementos y entre qué valores
$aleatorios = inicializar_array(10, 1, 20);
mostrar_array($aleatorios, 'Array de 10 enteros entre 1 y 20');

// Con otros valores se ve que la función no está escrita para un caso concreto
mostrar_array(inicializar_array(5, 100, 200), 'Array de 5 enteros entre 100 y 200');

echo "<p class='text-secondary small mb-0'>El número de elementos y los límites "
  . "mínimo y máximo son parámetros de <code>inicializar_array()</code>.</p>";
