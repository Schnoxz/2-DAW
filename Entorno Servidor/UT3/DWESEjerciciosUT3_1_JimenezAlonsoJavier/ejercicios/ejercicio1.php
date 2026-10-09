<?php
// ================= EJERCICIO 1 (opcional): lanzar una moneda =================
// Este archivo es un trozo de pagina: lo incluye index.php dentro del panel
// (pestaña) del ejercicio 1, asi que aqui NO va el <!DOCTYPE html> ni el <head>.
//
// El enunciado pide mostrar una imagen con la cara o la cruz cada vez que se
// refresca la pagina. Como no tengo imagenes de la moneda, la dibujo con un SVG
// en linea (una imagen vectorial hecha con etiquetas).

// rand(0, 1) devuelve un 0 o un 1 al azar, como una moneda al aire.
// Uso rand() porque es la funcion que explica la teoria (funciones numericas).
$moneda = rand(0, 1);

// Guardo los dos dibujos en variables para no repetir el SVG dos veces.
// El SVG es un circulo dorado; en la cara lleva una sonrisa y en la cruz una X.
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

echo "<h2 class='h4 text-primary'>Ejercicio 1: lanzar una moneda al aire</h2>";

// Segun salga 0 o 1 muestro un dibujo y el nombre del resultado
if ($moneda == 0) {
  echo $cara;
  echo "<p class='fs-4 mt-2'>Ha salido <strong>CARA</strong></p>";
} else {
  echo $cruz;
  echo "<p class='fs-4 mt-2'>Ha salido <strong>CRUZ</strong></p>";
}

echo "<hr>";
// text-secondary small pone el texto en gris y pequeño, como dato secundario
echo "<p class='text-secondary small'>Cada vez que recargues la pagina volvera a lanzarse la moneda.</p>";
