<?php
// Funciones de apoyo que usan varios ejercicios, para no repetir el mismo foreach.

// Pinta los valores de un array como una fila de etiquetas.
function mostrarArray($datos, $titulo = '')
{
  // El título es opcional: solo se pinta si nos lo pasan
  if ($titulo != '') {
    echo "<p class='fw-semibold mb-1'>$titulo</p>";
  }

  // d-flex + flex-wrap: las etiquetas van en fila y bajan de línea si no caben
  echo "<div class='d-flex flex-wrap gap-2 mb-3'>";
  foreach ($datos as $valor) {
    echo "<span class='badge text-bg-secondary fs-6'>$valor</span>";
  }
  echo "</div>";
}

// Pinta un array asociativo como una lista de "clave => valor".
function mostrarAsociativo($datos, $titulo = '')
{
  if ($titulo != '') {
    echo "<p class='fw-semibold mb-1'>$titulo</p>";
  }

  // list-group de Bootstrap: una línea por cada elemento
  echo "<ul class='list-group list-group-flush mb-3'>";
  foreach ($datos as $clave => $valor) {
    echo "<li class='list-group-item py-1'><span class='text-primary'>$clave</span> =&gt; $valor</li>";
  }
  echo "</ul>";
}
