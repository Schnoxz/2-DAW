<?php
// Ejercicio 2: adivinar la nota de un examen.

// Una nota al azar entre 1 y 10
$nota = rand(1, 10);

// Los tramos son [0,5) [5,6) [6,7) [7,9) y [9,10], por eso comparo con < y no con
// <=: un 5 ya cuenta como Suficiente.
if ($nota < 5) {
  $categoria = "Insuficiente";
  $color = "text-danger";     // rojo
} elseif ($nota < 6) {
  $categoria = "Suficiente";
  $color = "text-warning";    // naranja
} elseif ($nota < 7) {
  $categoria = "Bien";
  $color = "text-warning";
} elseif ($nota < 9) {
  $categoria = "Notable";
  $color = "text-success";    // verde
} else {
  // el 9 y el 10 caen aqui
  $categoria = "Sobresaliente";
  $color = "text-success";
}

echo "<h2 class='h4 text-primary'>Ejercicio 2: adivinar la nota</h2>";
echo "<p>La nota generada al azar es: <strong class='fs-3'>$nota</strong></p>";
echo "<p>Calificacion: <strong class='$color fs-4'>$categoria</strong></p>";
echo "<hr>";
echo "<p class='text-secondary small'>Tramos: [0,5) Insuficiente, [5,6) Suficiente, [6,7) Bien, [7,9) Notable, [9,10] Sobresaliente.</p>";
