<?php
// Funciones de apoyo que usan varios ejercicios.
// Sirven para no repetir el mismo foreach cada vez que hay que enseñar un array.

/**
 * Enseña los valores de un array como una fila de etiquetas.
 *
 * @param array  $datos  Array que se quiere mostrar.
 * @param string $titulo Texto opcional que aparece encima.
 */
function mostrarArray(array $datos, string $titulo = ''): void
{
    // Si nos pasan un título, lo pintamos en negrita
    if ($titulo !== '') {
        echo '<p class="fw-semibold mb-1">' . htmlspecialchars($titulo) . '</p>';
    }

    // d-flex + flex-wrap: las etiquetas se colocan en fila y bajan de línea
    echo '<div class="d-flex flex-wrap gap-2 mb-3">';
    foreach ($datos as $valor) {
        // htmlspecialchars convierte caracteres especiales (<, >, &) en texto
        // seguro, para que no puedan romper el HTML ni colarse como código.
        echo '<span class="badge text-bg-secondary fs-6">'
           . htmlspecialchars((string) $valor)
           . '</span>';
    }
    echo '</div>';
}

/**
 * Enseña un array asociativo como una lista de "clave => valor".
 * Se usa en los ejercicios de ordenación.
 *
 * @param array  $datos  Array asociativo que se quiere mostrar.
 * @param string $titulo Texto opcional que aparece encima.
 */
function mostrarAsociativo(array $datos, string $titulo = ''): void
{
    if ($titulo !== '') {
        echo '<p class="fw-semibold mb-1">' . htmlspecialchars($titulo) . '</p>';
    }

    // list-group de Bootstrap: lista con una línea por elemento
    echo '<ul class="list-group list-group-flush mb-3">';
    foreach ($datos as $clave => $valor) {
        echo '<li class="list-group-item py-1">'
           . '<span class="text-primary">' . htmlspecialchars((string) $clave) . '</span>'
           . ' =&gt; '
           . htmlspecialchars((string) $valor)
           . '</li>';
    }
    echo '</ul>';
}
