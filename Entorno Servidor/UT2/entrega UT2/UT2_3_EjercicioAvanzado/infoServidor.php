<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informacion del servidor</title>

  <!-- Estilos de Bootstrap 5, los cojo de un CDN para no escribir CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <div class="container mt-5 text-center">

    <h1>Informacion del servidor</h1>

    <?php
      // $_SERVER es una variable de PHP que guarda datos del servidor
      $nombreServidor = $_SERVER['SERVER_NAME'];
      $softwareServidor = $_SERVER['SERVER_SOFTWARE'];

      // La version de PHP es una constante, por eso no lleva el signo del dollar delante
      $versionPhp = PHP_VERSION;
    ?>

    <table class="table table-bordered">
      <tr>
        <th>Informacion</th>
        <th>Valor</th>
      </tr>
      <tr>
        <td>Nombre del servidor</td>
        <td><?= $nombreServidor ?></td>
      </tr>
      <tr>
        <td>Software del servidor</td>
        <td><?= $softwareServidor ?></td>
      </tr>
      <tr>
        <td>Version de PHP</td>
        <td><?= $versionPhp ?></td>
      </tr>
    </table>

    <br>

    <a class="btn btn-secondary" href="index.php">Volver a la pagina principal</a>

  </div>

</body>
</html>
