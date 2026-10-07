<?php
echo "<h1>Ejercicio 1</h1>\n";
// Creo un array con 6 peliculas llamado peliculas
$peliculas = [
    'Gladiator',
    'El irlandés',
    'Inception',
    'El Padrino',
    'Donnie Darko',
    'Shutter Island',
];
// Recorro con foreach el array peliculas y cada elemento interno se denomina pelicula, imprimiendo dentro del bucle el valor de pelicula dentro de un párrafo
foreach ($peliculas as $pelicula) {
    echo "<p>Película: $pelicula</p>\n";
}
echo "<hr>\n";
echo "<h1>Ejercicio 2</h1>\n";
// Similar a lo anterior, pero aquí se imprime con la posición del elemento dentro del array, que se obtiene con la variable $posicion donde es un simple índice que empieza en 0, por lo que se le suma 1 para que empiece en 1
foreach ($peliculas as $posicion => $pelicula) {
    echo "<p>Película " . ($posicion + 1) . ": $pelicula</p>\n";
}
echo "<hr>\n";

echo "<h1>Ejercicio 3</h1>\n";
// Le doy estilo a la tabla con CSS, y dentro del bucle foreach genero un color aleatorio para cada película, que se aplica al texto de la película
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