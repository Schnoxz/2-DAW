<?php
// 1. Imprime los números del 1 al 10.

echo "<h1>Ejercicio 1</h1>\n";
for ($i = 1; $i <= 10; $i++) {
    echo "$i<br>";
}

echo "<hr>";
// 2. Imprime los números del 60 al 70.

echo "<h1>Ejercicio 2</h1>\n";
for ($i = 60; $i <= 70; $i++) {
    echo "$i<br>";
}

echo "<hr>";
// 3. Imprime los números del 20 al 1, decrementando en 1 cada vez.

echo "<h1>Ejercicio 3</h1>\n";
for ($i = 20; $i >= 1; $i--) {
    echo "$i<br>";
}

echo "<hr>";

// 4. Imprime los números del 1 al 1000.

echo "<h1>Ejercicio 4</h1>\n";
for ($i = 1; $i <= 1000; $i++) {
    echo "$i<br>";
}
echo "<hr>";

// Tabla del 5, con el for se suma desde un indice 0 hasta 10, multiplicando por 5 cada vez.
echo "Ejercicio 5</h1>\n";
for ($i = 0; $i <= 10; $i++) {
    echo "5 x $i = " . (5 * $i) . "<br>";
}

// Una tabla donde cada celda es el producto de los dos contadores, y se escribe `5 x 3 = 15` con `echo` interpolando las variables.
echo "<h1>Ejercicio 6</h1>\n";
for ($i = 0; $i <= 10; $i++) {
    for ($j = 0; $j <= 10; $j++) {
        echo "$i x $j = " . ($i * $j) . "<br>";
    }
}
echo "<hr>";

