<?php

$peliculas = [
    'Los Vengadores',
    'Godzilla',
    'Interstellar',
    'El Padrino',
    'Matrix',
    'Casablanca',
];

foreach ($peliculas as $pelicula) {
    echo "<p>Película: $pelicula</p>\n";
}

foreach ($peliculas as $posicion => $pelicula) {
    echo "<p>Película " . ($posicion + 1) . ": $pelicula</p>\n";
}

echo <<<HTML
<style>
table {
    border-collapse: collapse;
    margin: 1rem 0;
}
th, td {
    border: 1px solid #333;
    padding: 8px 14px;
    text-align: left;
}
th {
    background-color: #eeeeee;
}
</style>

<table>
    <thead>
        <tr>
            <th>Posición</th>
            <th>Película</th>
        </tr>
    </thead>
    <tbody>
HTML;

foreach ($peliculas as $posicion => $pelicula) {
    $r = random_int(0, 255);
    $g = random_int(0, 255);
    $b = random_int(0, 255);

    $numero = $posicion + 1;
    echo "<tr><td>$numero</td><td style=\"color: rgb($r, $g, $b)\">$pelicula</td></tr>\n";
}

echo "</tbody>\n</table>\n";