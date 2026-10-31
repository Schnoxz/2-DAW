<?php
// Ejercicio 5 (opcional): ordenar las capitales por país y ponerlo todo en mayúsculas.

$capitales = [
  'Italy'          => 'Rome',
  'Luxembourg'     => 'Luxembourg',
  'Belgium'        => 'Brussels',
  'Denmark'        => 'Copenhagen',
  'Finland'        => 'Helsinki',
  'France'         => 'Paris',
  'Slovakia'       => 'Bratislava',
  'Slovenia'       => 'Ljubljana',
  'Germany'        => 'Berlin',
  'Greece'         => 'Athens',
  'Ireland'        => 'Dublin',
  'Netherlands'    => 'Amsterdam',
  'Portugal'       => 'Lisbon',
  'Spain'          => 'Madrid',
  'Sweden'         => 'Stockholm',
  'United Kingdom' => 'London',
  'Cyprus'         => 'Nicosia',
  'Lithuania'      => 'Vilnius',
  'Czech Republic' => 'Prague',
  'Estonia'        => 'Tallin',
  'Hungary'        => 'Budapest',
  'Latvia'         => 'Riga',
  'Malta'          => 'Valetta',
  'Austria'        => 'Vienna',
  'Poland'         => 'Warsaw',
];

// Función propia: devuelve un array nuevo con el país y la capital en mayúsculas
function aMayusculas($datos)
{
  $resultado = [];
  foreach ($datos as $pais => $capital) {
    // strtoupper pasa a mayúsculas tanto la clave como el valor
    $resultado[strtoupper($pais)] = strtoupper($capital);
  }
  return $resultado;
}

// ksort ordena por clave (el nombre del país) antes de pasar a mayúsculas
ksort($capitales);
$enMayusculas = aMayusculas($capitales);

echo "<h2 class='h4 text-primary'>Ejercicio 5: capitales ordenadas y en mayúsculas</h2>";
echo "<p>Array ordenado con <code>ksort()</code> y transformado con una función propia que usa <code>strtoupper()</code>.</p>";

// list-unstyled: lista sin viñetas; fs-5: letra un poco más grande
echo "<ul class='list-unstyled fs-5'>";
foreach ($enMayusculas as $pais => $capital) {
  echo "<li>$pais: $capital</li>";
}
echo "</ul>";
