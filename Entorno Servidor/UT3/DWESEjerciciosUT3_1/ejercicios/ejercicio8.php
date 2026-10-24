<?php
// Ejercicio 8 (obligatorio): dos tablas.
// La primera con los números del 1 al 100 y la segunda con emoticonos al azar.
?>
<h2 class="h4 text-primary">Ejercicio 8: tablas (obligatorio)</h2>

<h3 class="h5 mt-3">Apartado 1: números del 1 al 100</h3>
<!-- 10 columnas por 10 filas = 100 celdas. text-center centra el contenido. -->
<table class="table table-bordered table-sm text-center w-auto">
  <tbody>
    <?php
      // Recorro del 1 al 100. Como quiero 10 números por fila: abro la fila en el primero de cada decena (1, 11, 21...) y la cierro en el último (10, 20, 30...). El operador % da el resto.
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
<p>Los emoticonos cambian cada vez que se refresca la página.</p>
<?php
  // Los cinco emoticonos guardados por su código
  $emoticonos = [128169, 128168, 127866, 128405, 129313];
?>
<table class="table table-bordered text-center w-auto">
  <tbody>
    <?php
      // 10 filas de 10 celdas
      for ($fila = 1; $fila <= 10; $fila++) {
        echo "<tr>";
        for ($columna = 1; $columna <= 10; $columna++) {
          // Elijo una posición al azar del array y escribo ese emoticono
          $posicion = array_rand($emoticonos);
          $codigo = $emoticonos[$posicion];
          echo "<td class='fs-4'>&#$codigo;</td>";
        }
        echo "</tr>";
      }
    ?>
  </tbody>
</table>
