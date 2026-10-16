<?php
// Ejercicio 3: comprobar si tres numeros coinciden. El enunciado no pide
// formulario, asi que los genero aqui directamente.

$num1 = rand(1, 3);
$num2 = rand(1, 3);
$num3 = rand(1, 3);

// Primero miro si son los tres iguales
if ($num1 == $num2 && $num2 == $num3) {
  $mensaje = "hay tres numeros iguales a $num1";
} elseif ($num1 == $num2 || $num1 == $num3 || $num2 == $num3) {
  // Si son dos, averiguo cual se repite: si no es el primero, tiene que ser el segundo
  if ($num1 == $num2 || $num1 == $num3) {
    $repetido = $num1;
  } else {
    $repetido = $num2;
  }
  $mensaje = "hay dos numeros iguales a $repetido";
} else {
  // ninguno coincide
  $mensaje = "no hay numeros iguales";
}

echo "<h2 class='h4 text-primary'>Ejercicio 3: comprobar numeros iguales</h2>";
echo "<p>Los tres numeros son: <strong>$num1, $num2, $num3</strong></p>";
echo "<p class='fs-4'>" . ucfirst($mensaje) . ".</p>";
