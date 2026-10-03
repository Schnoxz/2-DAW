<?php

for ($i = 1; $i <= 10; $i++) {
    echo "$i<br>";
}

echo "<hr>";

for ($i = 60; $i <= 70; $i++) {
    echo "$i<br>";
}

echo "<hr>";

for ($i = 20; $i >= 1; $i--) {
    echo "$i<br>";
}

echo "<hr>";

for ($i = 1; $i <= 1000; $i++) {
    echo "$i<br>";
}

echo "<hr>";

echo "<table border='1' style='border-collapse: collapse'>\n";
for ($fila = 1; $fila <= 10; $fila++) {
    echo "<tr>";
    for ($columna = 1; $columna <= 10; $columna++) {
        echo "<td>" . ($fila * $columna) . "</td>";
    }
    echo "</tr>\n";
}
echo "</table>";

echo "<table border='1' style='border-collapse: collapse'>\n";
echo "<tr>";
for ($j = 1; $j <= 10; $j++) {
    echo "<td>5 x $j = " . (5 * $j) . "</td>";
}
echo "</tr>\n";
echo "</table>";