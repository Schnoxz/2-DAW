<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Operaciones Matematicas</title>

  <!-- Estilos de Bootstrap 5, los cojo de un CDN para no escribir CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <div class="container mt-5 text-center">

    <h1>Operaciones Matematicas</h1>

    <?php
      // Los parametros que vienen por GET se leen de la variable $_GET
      // intval() convierte el texto que llega por la URL en un numero entero
      $num1 = intval($_GET['num1']);
      $num2 = intval($_GET['num2']);
      $num3 = intval($_GET['num3']);

      // Sumar, multiplicar y dividir se hace con los simbolos de siempre
      $suma = $num1 + $num2 + $num3;
      $producto = $num1 * $num2 * $num3;

      // La media puede dar muchos decimales, round() la redondea a 2 decimales
      $media = round(($num1 + $num2 + $num3) / 3, 2);

      // Para saber el mayor y el menor no hay funcion, asi que comparo con if
      if ($num1 > $num2 && $num1 > $num3) {
        $mayor = $num1;
      } elseif ($num2 > $num3) {
        $mayor = $num2;
      } else {
        $mayor = $num3;
      }

      if ($num1 < $num2 && $num1 < $num3) {
        $menor = $num1;
      } elseif ($num2 < $num3) {
        $menor = $num2;
      } else {
        $menor = $num3;
      }
    ?>

    <h2>Numeros recibidos</h2>

    <p>num1 = <?= $num1 ?></p>
    <p>num2 = <?= $num2 ?></p>
    <p>num3 = <?= $num3 ?></p>

    <h2>Resultados</h2>

    <table class="table table-bordered">
      <tr>
        <th>Operacion</th>
        <th>Resultado</th>
      </tr>
      <tr>
        <td>Suma de los tres numeros</td>
        <td><?= $suma ?></td>
      </tr>
      <tr>
        <td>Producto de los tres numeros</td>
        <td><?= $producto ?></td>
      </tr>
      <tr>
        <td>Media de los tres numeros</td>
        <td><?= $media ?></td>
      </tr>
      <tr>
        <td>Numero mas grande</td>
        <td><?= $mayor ?></td>
      </tr>
      <tr>
        <td>Numero mas pequeno</td>
        <td><?= $menor ?></td>
      </tr>
    </table>

    <p>La media sale como <?= $media ?> porque en PHP el separador decimal es el punto.</p>

    <br>

    <a class="btn btn-secondary" href="index.php">Volver a la pagina principal</a>

  </div>

</body>
</html>
