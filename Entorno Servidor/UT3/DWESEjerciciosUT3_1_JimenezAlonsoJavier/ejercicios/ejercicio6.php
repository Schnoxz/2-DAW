<?php
// Ejercicio 6: la tabla de multiplicar (del 1 al 10) de un numero al azar.

$numero = rand(); 

echo "<h2 class='h4 text-primary'>Ejercicio 6: tabla de multiplicar</h2>";
echo "<p>Numero generado al azar: <strong class='fs-3'>$numero</strong></p>";
?>
<table class="table table-bordered table-striped" style="max-width: 400px;">
  <thead>
    <tr>
      <th>Operacion</th>
      <th>Resultado</th>
    </tr>
  </thead>
  <tbody>
    <?php
      for ($i = 1; $i <= 10; $i++) {
        $resultado = $numero * $i;
        echo "<tr><td>$numero x $i</td><td><strong>$resultado</strong></td></tr>";
      }
    ?>
  </tbody>
</table>
