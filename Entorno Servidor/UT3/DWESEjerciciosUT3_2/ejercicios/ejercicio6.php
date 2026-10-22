<?php
// Ejercicio 6 (opcional): pasar el array de capitales a JSON.
// json_encode() convierte un array de PHP en un texto JSON.
require_once __DIR__ . '/helpers.php';

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

// JSON_PRETTY_PRINT: con saltos de línea y sangría, para que se lea.
// JSON_UNESCAPED_UNICODE: los acentos se escriben tal cual y no como \u00ed.
$json = json_encode($capitales, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

echo '<h2 class="h4 text-primary">Ejercicio 6: el array convertido a JSON</h2>';
echo '<p>Resultado de <code>json_encode()</code>:</p>';

// <pre> respeta los saltos de línea y los espacios del JSON.
// htmlspecialchars evita que las comillas y las llaves se interpreten como HTML.
echo '<pre class="bg-light border rounded p-3"><code>'
   . htmlspecialchars($json)
   . '</code></pre>';

echo '<p class="text-secondary small mb-0">Un array asociativo se convierte en un objeto JSON; '
   . 'si las claves fueran números seguidos, saldría como una lista [ ... ].</p>';
