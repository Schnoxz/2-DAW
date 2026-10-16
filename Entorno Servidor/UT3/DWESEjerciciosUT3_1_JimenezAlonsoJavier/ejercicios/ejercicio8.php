<?php
// Ejercicio 8 (obligatorio): tablas.
?>
<h2 class="h4 text-primary">Ejercicio 8: tablas (obligatorio)</h2>

<h3 class="h5 mt-3">Apartado 1: numeros del 1 al 100</h3>
<!-- 10 columnas x 10 filas = 100 celdas -->
<table class="table table-bordered table-sm text-center" style="max-width: 500px;">
  <tbody>
    <?php
      // 10 numeros por fila: abro la fila en el primero de cada decena (1, 11, 21...)
      // y la cierro en el ultimo (10, 20, 30...)
      for ($i = 1; $i <= 100; $i++) {
        if ($i % 10 == 1) {
          echo "<tr>";
        }
        echo "<td>$i</td>";
        if ($i % 10 == 0) {
          echo "</tr>";
        }
      }
    ?>
  </tbody>
</table>

<h3 class="h5 mt-4">Apartado 2: tabla de emoticonos al azar</h3>
<p>Los emoticonos cambian cada vez que se refresca la pagina.</p>
<?php
  // los 5 emoticonos que permite el enunciado
  $emoticonos = [128169, 128168, 127866, 128405, 129313];
?>
<table class="table table-bordered text-center" style="max-width: 500px;">
  <tbody>
    <?php
      for ($fila = 1; $fila <= 10; $fila++) {
        echo "<tr>";
        for ($columna = 1; $columna <= 10; $columna++) {
          // una posicion al azar del array de emoticonos
          $posicion = array_rand($emoticonos);
          $codigo = $emoticonos[$posicion];
          echo "<td class='fs-4'>&#$codigo;</td>";
        }
        echo "</tr>";
      }
    ?>
  </tbody>
</table>
