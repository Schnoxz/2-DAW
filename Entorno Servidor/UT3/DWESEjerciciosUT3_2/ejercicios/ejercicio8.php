<?php
// Ejercicio 8 (OBLIGATORIO): suma de los pares y de los impares de un array.
// Solo se usan arrays y estructuras de control; Bootstrap solo para la tabla.

require_once __DIR__ . '/helpers.php';

// Array de 10 enteros al azar entre 1 y 100
$numeros = [];
for ($i = 0; $i < 10; $i++) {
    $numeros[] = rand(1, 100);
}

// Aquí voy acumulando las sumas y guardando los números de cada tipo
$sumaPares = 0;
$sumaImpares = 0;
$cuentaPares = 0;
$cuentaImpares = 0;
$pares = [];
$impares = [];

// Recorro el array una sola vez y reparto cada número en su grupo.
// El operador % (resto) vale 0 cuando el número es par.
foreach ($numeros as $numero) {
    if ($numero % 2 === 0) {
        $sumaPares += $numero;
        $cuentaPares++;
        $pares[] = $numero;
    } else {
        $sumaImpares += $numero;
        $cuentaImpares++;
        $impares[] = $numero;
    }
}

echo '<h2 class="h4 text-primary">Ejercicio 8: suma de pares e impares (obligatorio)</h2>';
mostrarArray($numeros, 'Array $numeros (10 enteros aleatorios entre 1 y 100)');
?>

<!-- table-responsive: si la tabla no cabe, aparece scroll horizontal.
     table-primary colorea la cabecera y table-secondary el pie. -->
<div class="table-responsive">
  <table class="table table-bordered table-striped align-middle">
    <thead class="table-primary">
      <tr>
        <th scope="col">Tipo</th>
        <th scope="col">Cantidad</th>
        <th scope="col">Números</th>
        <th scope="col" class="text-end">Suma</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">Pares</th>
        <td><?= $cuentaPares ?></td>
        <!-- implode une los números con comas; si no hay ninguno, se pinta un guion -->
        <td><?= $pares ? htmlspecialchars(implode(', ', $pares)) : '—' ?></td>
        <td class="text-end fw-bold"><?= $sumaPares ?></td>
      </tr>
      <tr>
        <th scope="row">Impares</th>
        <td><?= $cuentaImpares ?></td>
        <td><?= $impares ? htmlspecialchars(implode(', ', $impares)) : '—' ?></td>
        <td class="text-end fw-bold"><?= $sumaImpares ?></td>
      </tr>
    </tbody>
    <tfoot class="table-secondary">
      <tr>
        <th scope="row">Total</th>
        <td colspan="2"><?= count($numeros) ?> números</td>
        <td class="text-end fw-bold"><?= $sumaPares + $sumaImpares ?></td>
      </tr>
    </tfoot>
  </table>
</div>

<p class="text-secondary small mb-0">La suma total coincide con la suma de todos los elementos del array.</p>
