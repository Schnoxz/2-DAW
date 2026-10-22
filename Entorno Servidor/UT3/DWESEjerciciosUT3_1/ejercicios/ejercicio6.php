<?php
// Ejercicio 6: mostrar la tabla de multiplicar (del 1 al 10) de un número al azar.

// rand(1, 10) da un número manejable. Si se llama a rand() sin argumentos,
// el número es enorme y la tabla sale ilegible.
$numero = rand(1, 10);

echo "<h2 class='h4 text-primary'>Ejercicio 6: tabla de multiplicar</h2>";
echo "<p>Número generado al azar: <strong class='fs-3'>$numero</strong></p>";
?>
<!-- w-auto: la tabla ocupa solo lo que necesita, no todo el ancho -->
<table class="table table-bordered table-striped w-auto">
  <thead>
    <tr>
      <th>Operación</th>
      <th>Resultado</th>
    </tr>
  </thead>
  <tbody>
    <?php
      // Diez filas: una por cada multiplicación del 1 al 10
      for ($i = 1; $i <= 10; $i++) {
        $resultado = $numero * $i;
        echo "<tr><td>$numero x $i</td><td><strong>$resultado</strong></td></tr>";
      }
    ?>
  </tbody>
</table>
