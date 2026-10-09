<?php
// ================= EJERCICIO 2 (opcional): nota aleatoria =================
// Trozo de pagina que index.php incluye dentro de la pestaña del ejercicio 2.

// Genero una nota al azar entre 1 y 10, que es lo que pide el enunciado
$nota = rand(1, 10);

// Con una cadena de if / elseif clasifico la nota en su tramo.
// OJO: los intervalos son [0,5) [5,6) [6,7) [7,9) y [9,10].
// El corchete [ significa "incluido" y el parentesis ) "no incluido",
// por eso uso < y no <= (5 es Suficiente, no Insuficiente).
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
  // Esta rama recoge el 9 y el 10 (Sobresaliente)
  $categoria = "Sobresaliente";
  $color = "text-success";
}

echo "<h2 class='h4 text-primary'>Ejercicio 2: adivinar la nota</h2>";
echo "<p>La nota generada al azar es: <strong class='fs-3'>$nota</strong></p>";
// El color cambia segun el tramo, para que se vea de un vistazo
echo "<p>Calificacion: <strong class='$color fs-4'>$categoria</strong></p>";
echo "<hr>";
echo "<p class='text-secondary small'>Tramos: [0,5) Insuficiente, [5,6) Suficiente, [6,7) Bien, [7,9) Notable, [9,10] Sobresaliente.</p>";
