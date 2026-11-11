<?php
// Ejercicio 4: el valor máximo de un array.

echo "<h2 class='h4 text-primary'>Ejercicio 4: valor máximo de un array</h2>";

// Meto un número negativo a propósito para comprobar que la función no
// se queda con el 0 como valor inicial
$temperaturas = [-3, 12, 7, -8, 21, 4];
mostrar_array($temperaturas, 'Temperaturas');

echo "<p>La temperatura más alta es <strong>" . calcular_maximo($temperaturas)
  . "</strong>.</p>";
