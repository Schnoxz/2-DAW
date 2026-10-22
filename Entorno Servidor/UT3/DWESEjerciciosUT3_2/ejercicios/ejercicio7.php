<?php
// Ejercicio 7 (OBLIGATORIO): sustituir por "suspenso" los valores menores que 5.

require_once __DIR__ . '/helpers.php';

// 1) Array de 50 números al azar entre 1 y 10
$valores = [];
for ($i = 0; $i < 50; $i++) {
    $valores[] = rand(1, 10);
}

echo '<h2 class="h4 text-primary">Ejercicio 7: sustituir los suspensos (obligatorio)</h2>';

// 2) Enseño el array tal cual ha salido
mostrarArray($valores, '1-2) Array de 50 valores aleatorios entre 1 y 10');

// 3) Cambio los menores que 5. El & delante de $valor es importante: hace que
// el foreach trabaje con el elemento real del array y no con una copia. Sin
// el &, los cambios se perderían al terminar el bucle (es lo que explica la
// teoría en el apartado de arrays).
foreach ($valores as &$valor) {
    if ($valor < 5) {
        $valor = 'suspenso';
    }
}
unset($valor);   // se corta la referencia al acabar el bucle

// 4) Enseño el array ya modificado
mostrarArray($valores, '3-4) Array con los valores menores que 5 sustituidos');
