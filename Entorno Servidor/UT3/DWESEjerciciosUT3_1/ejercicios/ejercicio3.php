<?php
// Ejercicio 3: comprobar si hay números iguales entre tres números positivos.
// No hace falta formulario: genero tres números al azar entre 1 y 3, así es
// fácil que a veces coincidan y se vean los tres casos posibles.

$num1 = rand(1, 3);
$num2 = rand(1, 3);
$num3 = rand(1, 3);

// Los tres iguales: se cumple si el primero es igual al segundo y el segundo al tercero
if ($num1 == $num2 && $num2 == $num3) {
  $mensaje = "hay tres números iguales a $num1";
} elseif ($num1 == $num2 || $num1 == $num3 || $num2 == $num3) {
  // Dos iguales: averiguo cuál es el repetido.
  // Si coincide con el primero, ese es; si no, tiene que ser el segundo.
  if ($num1 == $num2 || $num1 == $num3) {
    $repetido = $num1;
  } else {
    $repetido = $num2;
  }
  $mensaje = "hay dos números iguales a $repetido";
} else {
  // Ninguna de las comparaciones anteriores se ha cumplido
  $mensaje = "no hay números iguales";
}

// ucfirst pone en mayúscula la primera letra de la frase
echo "<h2 class='h4 text-primary'>Ejercicio 3: comprobar números iguales</h2>";
echo "<p>Los tres números son: <strong>$num1, $num2, $num3</strong></p>";
echo "<p class='fs-4'>" . ucfirst($mensaje) . ".</p>";
