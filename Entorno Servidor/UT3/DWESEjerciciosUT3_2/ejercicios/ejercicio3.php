<?php
// Ejercicio 3 (opcional): array multidimensional de países y ciudades.

// Cada clave es un país y su valor es otro array con tres ciudades
$paises = [
  'España'   => ['Madrid', 'Barcelona', 'Valencia'],
  'Francia'  => ['París', 'Lyon', 'Marsella'],
  'Italia'   => ['Roma', 'Milán', 'Nápoles'],
  'Portugal' => ['Lisboa', 'Oporto', 'Coímbra'],
  'Alemania' => ['Berlín', 'Múnich', 'Hamburgo'],
];

echo "<h2 class='h4 text-primary'>Ejercicio 3: array multidimensional de países y ciudades</h2>";

// El primer foreach saca el país y su lista de ciudades; el segundo recorre esa lista
foreach ($paises as $pais => $ciudades) {
  // Una tarjeta de Bootstrap por cada país
  echo "<div class='card mb-3'>";
  echo "  <div class='card-header fw-semibold'>$pais</div>";

  echo "  <ul class='list-group list-group-flush'>";
  foreach ($ciudades as $ciudad) {
    echo "    <li class='list-group-item py-1'>$ciudad</li>";
  }
  echo "  </ul>";
  echo "</div>";
}

echo "<p class='text-secondary small mb-0'>El array tiene " . count($paises)
   . " países y se recorre con un foreach dentro de otro.</p>";
