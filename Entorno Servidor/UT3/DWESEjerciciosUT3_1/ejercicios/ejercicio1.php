<?php
// Ejercicio 1: lanzar una moneda al aire.
// Este archivo se incluye dentro de una pestaña de index.php, así que aquí
// solo va el trozo de HTML/PHP que se ve en esa pestaña (sin <html> ni <head>).

// rand(0, 1) devuelve 0 o 1 al azar, como si la moneda cayera de un lado o de otro.
$moneda = rand(0, 1);

// Dibujo las dos caras con SVG para no depender de archivos de imagen.
// Cada variable guarda el dibujo completo como texto.
$cara = '<svg width="140" height="140" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Cara de la moneda">'
      . '<circle cx="60" cy="60" r="55" fill="#f1c40f" stroke="#b7950b" stroke-width="5"/>'
      . '<circle cx="42" cy="48" r="6" fill="#7d6608"/>'
      . '<circle cx="78" cy="48" r="6" fill="#7d6608"/>'
      . '<path d="M38 72 Q60 92 82 72" stroke="#7d6608" stroke-width="5" fill="none" stroke-linecap="round"/>'
      . '</svg>';
$cruz = '<svg width="140" height="140" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Cruz de la moneda">'
      . '<circle cx="60" cy="60" r="55" fill="#f1c40f" stroke="#b7950b" stroke-width="5"/>'
      . '<line x1="38" y1="38" x2="82" y2="82" stroke="#7d6608" stroke-width="8" stroke-linecap="round"/>'
      . '<line x1="82" y1="38" x2="38" y2="82" stroke="#7d6608" stroke-width="8" stroke-linecap="round"/>'
      . '</svg>';

// Título del ejercicio (clases de Bootstrap: h4 = tamaño, text-primary = azul)
echo "<h2 class='h4 text-primary'>Ejercicio 1: lanzar una moneda al aire</h2>";

// Si salió 0 mostramos cara; si salió 1, cruz
if ($moneda == 0) {
  echo $cara;
  echo "<p class='fs-4 mt-2'>Ha salido <strong>CARA</strong></p>";
} else {
  echo $cruz;
  echo "<p class='fs-4 mt-2'>Ha salido <strong>CRUZ</strong></p>";
}

echo "<hr>";
// Aviso en letra pequeña y gris
echo "<p class='text-secondary small'>Cada vez que recargues la página volverá a lanzarse la moneda.</p>";
