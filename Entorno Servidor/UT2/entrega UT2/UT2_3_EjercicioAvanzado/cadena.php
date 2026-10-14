<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Operaciones con Cadenas</title>

  <!-- Estilos de Bootstrap 5, los cojo de un CDN para no escribir CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <div class="container mt-5 text-center">

    <h1>Operaciones con Cadenas</h1>

    <?php
      // Las dos cadenas llegan por GET dentro de $_GET
      $cadena1 = $_GET['cadena1'];
      $cadena2 = $_GET['cadena2'];

      // El punto se usa para pegar dos cadenas
      $concatenada = $cadena1 . " " . $cadena2 . " del barrio";

      // mb_strlen() cuenta las letras. Se usa mb_ en vez de strlen() porque si la cadena
      // lleva tildes o ñ, strlen() contaria los bytes de cada letra y daria un numero mas grande
      $largo1 = mb_strlen($cadena1);
      $largo2 = mb_strlen($cadena2);

      // mb_substr() corta la cadena. Con -10 le digo que coja los ultimos 10 caracteres
      $ultimos10 = mb_substr($cadena2, -10);

      // str_replace() cambia una parte del texto por otra. La palabra Paco esta en la cadena 1
      $reemplazada = str_replace("Paco", "Maria", $cadena1);
    ?>

    <h2>Cadenas recibidas</h2>

    <p>cadena1 = <?= $cadena1 ?></p>
    <p>cadena2 = <?= $cadena2 ?></p>

    <h2>Resultados</h2>

    <table class="table table-bordered">
      <tr>
        <th>Operacion</th>
        <th>Resultado</th>
      </tr>
      <tr>
        <td>Cadena concatenada</td>
        <td><?= $concatenada ?></td>
      </tr>
      <tr>
        <td>Longitud de la cadena 1</td>
        <td><?= $largo1 ?></td>
      </tr>
      <tr>
        <td>Longitud de la cadena 2</td>
        <td><?= $largo2 ?></td>
      </tr>
      <tr>
        <td>Ultimos 10 caracteres de la cadena 2</td>
        <td><?= $ultimos10 ?></td>
      </tr>
      <tr>
        <td>Cadena 1 con Paco cambiado por Maria</td>
        <td><?= $reemplazada ?></td>
      </tr>
    </table>

    <br>

    <a class="btn btn-secondary" href="index.php">Volver a la pagina principal</a>

  </div>

</body>
</html>
