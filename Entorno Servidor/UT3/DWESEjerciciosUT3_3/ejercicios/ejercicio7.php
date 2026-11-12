<?php
// Ejercicio 7 (OBLIGATORIO): el ejercicio de UT3_2 resuelto otra vez, ahora
// usando las funciones de funciones.php en lugar de escribir el código suelto.

echo "<h2 class='h4 text-primary'>Ejercicio 7: UT3_2 con funciones (obligatorio)</h2>";

// 1) Array de 10 elementos con valores aleatorios entre 1 y 30
$array = inicializar_array(10, 1, 30);

// 2) Imprimir todos los valores que almacena
mostrar_array($array, 'Array de 10 elementos entre 1 y 30');

// 3) y 4) Calcular y mostrar el valor medio
$media = calcular_media($array);
echo "<p>El valor medio es <strong>" . round($media, 2) . "</strong>.</p>";

// 5) y 6) Los tres valores máximos y los tres mínimos
echo "<div class='row g-3'>";
echo "<div class='col-md-6'>";
mostrar_array(tresMayores($array), 'Los 3 valores máximos');
echo "</div>";
echo "<div class='col-md-6'>";
mostrar_array(tresMenores($array), 'Los 3 valores mínimos');
echo "</div>";
echo "</div>";

// Compruebo que el máximo y el mínimo de las relaciones anteriores coinciden
// con el primero de cada lista de tres
echo "<p>El máximo del array es <strong>" . calcular_maximo($array)
  . "</strong> y el mínimo <strong>" . calcular_minimo($array) . "</strong>.</p>";

// Y lo dejo también como tabla, con la función del ejercicio 6
imprimir_array($array);
