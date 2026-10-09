<?php
// ================= EJERCICIO 3 (opcional): tres numeros iguales =================
// Trozo de pagina que index.php incluye dentro de la pestaña del ejercicio 3.
//
// El enunciado pide leer tres numeros positivos. Como no especifica un formulario,
// los genero con rand() entre 1 y 3. Los comparo con if / elseif.

$num1 = rand(1, 3);
$num2 = rand(1, 3);
$num3 = rand(1, 3);

// Comparo los tres para ver cuantas coincidencias hay.
// && es el "y" logico, || es el "o" logico.
if ($num1 == $num2 && $num2 == $num3) {
  // Los tres iguales (ejemplo 5 5 5)
  $mensaje = "hay tres numeros iguales a $num1";
} elseif ($num1 == $num2 || $num1 == $num3 || $num2 == $num3) {
  // Hay dos iguales (ejemplo 4 6 4). Busco cual es el valor repetido:
  // si num1 coincide con alguno de los otros dos, el repetido es num1;
  // si no, el repetido solo puede ser num2 (que coincide con num3).
  if ($num1 == $num2 || $num1 == $num3) {
    $repetido = $num1;
  } else {
    $repetido = $num2;
  }
  $mensaje = "hay dos numeros iguales a $repetido";
} else {
  // Ninguno coincide (ejemplo 0 1 2)
  $mensaje = "no hay numeros iguales";
}

echo "<h2 class='h4 text-primary'>Ejercicio 3: comprobar numeros iguales</h2>";
echo "<p>Los tres numeros son: <strong>$num1, $num2, $num3</strong></p>";
// ucfirst() pone en mayuscula la primera letra y le añado un punto final
echo "<p class='fs-4'>" . ucfirst($mensaje) . ".</p>";
