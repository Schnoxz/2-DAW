<?php
// Ejercicio 1 (opcional): crear un array de 10 aleatorios entre 1 y 30 y enseñarlo.

// require_once carga helpers.php una sola vez, aunque se incluya varias veces.
// De ahí salen las funciones mostrarArray() y mostrarAsociativo().
require_once __DIR__ . '/helpers.php';

// Array vacío. Al usar $numeros[] = ..., PHP añade el valor al final con la
// clave automática 0, 1, 2...
$numeros = [];
for ($i = 0; $i < 10; $i++) {
    $numeros[] = rand(1, 30);
}

echo '<h2 class="h4 text-primary">Ejercicio 1: array de 10 aleatorios</h2>';
echo '<p>Se ha creado un array de 10 elementos con valores aleatorios entre 1 y 30.</p>';

// La función recorre el array y pinta cada número
mostrarArray($numeros, 'Contenido del array');

echo '<p class="text-secondary small mb-0">Recargando la página se generan otros diez números.</p>';
