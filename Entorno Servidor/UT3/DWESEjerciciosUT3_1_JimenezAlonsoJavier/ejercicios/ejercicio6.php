<?php
// ================= EJERCICIO 6 (opcional): tabla de multiplicar =================
// Trozo de pagina que index.php incluye dentro de la pestaña del ejercicio 6.

// Genero un numero al azar entre 1 y 12 y muestro su tabla de multiplicar
$numero = rand(1, 12);

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
      // Recorro del 1 al 10 y en cada vuelta pinto una fila de la tabla
      for ($i = 1; $i <= 10; $i++) {
        $resultado = $numero * $i;
        // El punto (.) sirve para pegar textos con variables dentro de un echo
        echo "<tr><td>$numero x $i</td><td><strong>$resultado</strong></td></tr>";
      }
    ?>
  </tbody>
</table>
