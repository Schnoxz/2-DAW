<?php
// Ejercicio 5 (opcional): ordenar las capitales por país y ponerlo todo en
// mayúsculas, usando una función propia.

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

/**
 * Devuelve una copia del array con las claves y los valores en mayúsculas.
 *
 * @param array $datos Array de partida.
 * @return array Array nuevo ya transformado.
 */
function aMayusculas(array $datos): array
{
    // array_change_key_case cambia las claves a mayúsculas (CASE_UPPER)
    $resultado = array_change_key_case($datos, CASE_UPPER);

    // array_map aplica strtoupper a cada valor del array y devuelve el resultado
    return array_map('strtoupper', $resultado);
}

// ksort ordena por clave (por el nombre del país) antes de pasar a mayúsculas
ksort($capitales);
$enMayusculas = aMayusculas($capitales);

echo '<h2 class="h4 text-primary">Ejercicio 5: capitales ordenadas y en mayúsculas</h2>';
echo '<p>Array ordenado con <code>ksort()</code> y transformado con una función propia '
   . 'que usa <code>array_change_key_case()</code> y <code>array_map()</code>.</p>';

// list-unstyled: lista sin viñetas; fs-5: letra un poco más grande
echo '<ul class="list-unstyled fs-5">';
foreach ($enMayusculas as $pais => $capital) {
    echo '<li>' . htmlspecialchars($pais) . ': ' . htmlspecialchars($capital) . '</li>';
}
echo '</ul>';
