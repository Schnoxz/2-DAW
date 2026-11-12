<?php
// Ejercicio 1: tres funciones para ver cómo se pasan los parámetros y cómo se
// devuelve (o no) un valor.

echo "<h2 class='h4 text-primary'>Ejercicio 1: funciones y parámetros</h2>";

// --- a) Suma de cinco números escritos a mano ---
echo "<h3 class='h6 mt-3'>a) Suma de cinco números</h3>";
// Esta función no devuelve nada: al llamarla ya pinta el resultado
sumarCinco(4, 7, 2, 9, 5);

// --- b) División de dos de cinco números aleatorios ---
echo "<h3 class='h6 mt-3'>b) División de dos de esos cinco números</h3>";
$numeros = [];
for ($i = 0; $i < 5; $i++) {
  // Entre 0 y 9, como pide el enunciado: alguna vez saldrá un 0
  $numeros[] = rand(0, 9);
}
mostrar_array($numeros, 'Números generados');

// try/catch: si el segundo número sale 0 la función lanza una excepción y
// el programa no se rompe, solo mostramos el error
try {
  $tmp = dividirDosDeCinco($numeros[0], $numeros[1], $numeros[2], $numeros[3], $numeros[4]);
  // Muestro $tmp redondeado a dos decimales para que no salga una tira de cifras
  echo "<p>El valor de \$tmp es <strong>" . round($tmp, 2) . "</strong>.</p>";
} catch (Exception $e) {
  // getMessage() devuelve el texto que le hemos pasado al lanzar la excepción
  echo "<p class='text-danger'>Error: " . $e->getMessage() . "</p>";
}

// --- c) Volumen de un cilindro ---
echo "<h3 class='h6 mt-3'>c) Volumen de un cilindro</h3>";
$volumen = volumenCilindro(3, 10);
echo "<p>Un cilindro de radio 3 y altura 10 tiene un volumen de <strong>"
  . round($volumen, 2) . "</strong>.</p>";
