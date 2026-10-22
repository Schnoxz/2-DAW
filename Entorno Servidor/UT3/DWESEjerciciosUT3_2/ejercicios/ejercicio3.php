<?php
// Ejercicio 3 (opcional): array multidimensional de países y ciudades.

require_once __DIR__ . '/helpers.php';

// Cada clave es un país y su valor es otro array con tres ciudades.
// Esto es un array de dos dimensiones: para llegar a una ciudad hay que pasar
// por el país y luego por la posición de la ciudad.
$paises = [
    'España'   => ['Madrid', 'Barcelona', 'Valencia'],
    'Francia'  => ['París', 'Lyon', 'Marsella'],
    'Italia'   => ['Roma', 'Milán', 'Nápoles'],
    'Portugal' => ['Lisboa', 'Oporto', 'Coímbra'],
    'Alemania' => ['Berlín', 'Múnich', 'Hamburgo'],
];

echo '<h2 class="h4 text-primary">Ejercicio 3: array multidimensional de países y ciudades</h2>';

// Primer foreach: recorre los países. En $pais tenemos la clave y en $ciudades
// el array de ciudades de ese país.
foreach ($paises as $pais => $ciudades) {
    // Una tarjeta de Bootstrap por cada país
    echo '<div class="card mb-3">';
    echo '  <div class="card-header fw-semibold">' . htmlspecialchars($pais) . '</div>';

    // Segundo foreach: recorre las ciudades del país que toca
    echo '  <ul class="list-group list-group-flush">';
    foreach ($ciudades as $ciudad) {
        echo '<li class="list-group-item py-1">' . htmlspecialchars($ciudad) . '</li>';
    }
    echo '  </ul>';
    echo '</div>';
}

echo '<p class="text-secondary small mb-0">El array tiene '
   . count($paises) . ' países y se recorre con un foreach dentro de otro.</p>';
