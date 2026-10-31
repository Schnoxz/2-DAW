<?php
// Ejercicio 6 (opcional): pasar el array de capitales a JSON.

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

// JSON_PRETTY_PRINT lo deja con saltos de línea y sangría; JSON_UNESCAPED_UNICODE escribe los acentos tal cual
$json = json_encode($capitales, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

echo "<h2 class='h4 text-primary'>Ejercicio 6: el array convertido a JSON</h2>";
echo "<p>Resultado de <code>json_encode()</code>:</p>";

// <pre> respeta los saltos de línea y los espacios del JSON
echo "<pre class='bg-light border rounded p-3'><code>$json</code></pre>";

echo "<p class='text-secondary small mb-0'>Un array asociativo se convierte en un objeto JSON; si las claves fueran números seguidos, saldría como una lista [ ... ].</p>";
