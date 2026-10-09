<?php
// EJERCICIO 8  tablas 
// Trozo de pagina que index.php incluye dentro de la pestaña del ejercicio 8.
?>
<h2 class="h4 text-primary">Ejercicio 8: tablas (obligatorio)</h2>

<h3 class="h5 mt-3">Apartado 1: numeros del 1 al 100</h3>
<!-- Tabla de 10 columnas x 10 filas = 100 celdas -->
<table class="table table-bordered table-sm text-center" style="max-width: 500px;">
  <tbody>
    <?php
      // Recorro del 1 al 100. Cada 10 numeros (cuando el resto de dividir
      // entre 10 es 1) abro una fila, y cuando el resto es 0 la cierro.
      for ($i = 1; $i <= 100; $i++) {
        if ($i % 10 == 1) {
          // Empieza una fila nueva (el 1, el 11, el 21...)
          echo "<tr>";
        }
        echo "<td>$i</td>";
        if ($i % 10 == 0) {
          // Termina la fila (el 10, el 20, el 30...)
          echo "</tr>";
        }
      }
    ?>
  </tbody>
</table>

<h3 class="h5 mt-4">Apartado 2: tabla de emoticonos al azar</h3>
<p>Los emoticonos cambian cada vez que se refresca la pagina.</p>
<?php
  // Estos son los 5 emoticonos permitidos por el enunciado.
  // Los guardo en un array y luego elijo uno al azar de dentro con array_rand().
  $emoticonos = [128169, 128168, 127866, 128405, 129313];
?>
<table class="table table-bordered text-center" style="max-width: 500px;">
  <tbody>
    <?php
      // 10 filas x 10 columnas = 100 celdas
      for ($fila = 1; $fila <= 10; $fila++) {
        echo "<tr>";
        for ($columna = 1; $columna <= 10; $columna++) {
          // array_rand() elige una posicion al azar del array de emoticonos
          $posicion = array_rand($emoticonos);
          $codigo = $emoticonos[$posicion];
          echo "<td class='fs-4'>&#$codigo;</td>";
        }
        echo "</tr>";
      }
    ?>
  </tbody>
</table>
