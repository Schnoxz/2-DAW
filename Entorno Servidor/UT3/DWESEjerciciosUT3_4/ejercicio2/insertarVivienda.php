<?php
// Ejercicio 2: recibe la vivienda por POST, comprueba los campos obligatorios
// y, si están bien, muestra un resumen de los datos que se guardarían.

// Recogemos los valores comprobando que existen. Los campos de texto se
// recortan para que un espacio en blanco no cuente como dato válido.
$tipo = isset($_POST['tipo']) ? trim($_POST['tipo']) : '';
$zona = isset($_POST['zona']) ? trim($_POST['zona']) : '';
$direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : '';
$habitaciones = isset($_POST['habitaciones']) ? trim($_POST['habitaciones']) : '';
$precio = isset($_POST['precio']) ? trim($_POST['precio']) : '';
$observaciones = isset($_POST['observaciones']) ? trim($_POST['observaciones']) : '';
$extras = isset($_POST['extras']) ? $_POST['extras'] : [];

// En este ejercicio solo son obligatorios el tipo y el precio
$errores = [];
if ($tipo == '') {
  $errores[] = 'El tipo de vivienda es obligatorio.';
}
if ($precio == '') {
  $errores[] = 'El precio es obligatorio.';
} elseif (!is_numeric($precio) || $precio <= 0) {
  $errores[] = 'El precio tiene que ser un número mayor que 0.';
}

// tipos_validos()
// Devuelve los tipos de vivienda que admite el formulario.
function tipos_validos()
{
  return ['Adosado', 'Unifamiliar', 'Piso'];
}

// Si el tipo no está en la lista, tampoco vale: así no se cuela un valor
// inventado cambiando el HTML desde el navegador.
if ($tipo != '' && !in_array($tipo, tipos_validos())) {
  $errores[] = 'El tipo de vivienda no es válido.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicio 2 - Resultado del alta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/estilos.css" rel="stylesheet">
</head>
<body class="bg-light">
  <main class="container py-4">

    <?php if (count($errores) > 0) { ?>

      <h1 class="h3 text-danger">No se puede guardar la vivienda</h1>

      <div class="alert alert-danger">
        <p class="mb-2"><strong>FALTAN DATOS</strong> o no son correctos:</p>
        <ul class="mb-0">
          <?php
          // Recorremos el array de errores para enseñar todos, no solo el primero
          foreach ($errores as $error) {
            echo '<li>' . htmlspecialchars($error) . '</li>';
          }
          ?>
        </ul>
      </div>

      <a href="index.php" class="btn btn-primary">Volver al formulario</a>

    <?php } else { ?>

      <h1 class="h3 text-primary">Resumen de la vivienda</h1>
      <p class="text-muted">Estos son los datos que se guardarían (todavía sin base de datos).</p>

      <table class="table table-bordered bg-white">
        <caption class="visually-hidden">Datos de la vivienda introducida</caption>
        <tbody>
          <tr>
            <th scope="row" class="w-25">Tipo de vivienda</th>
            <td><?= htmlspecialchars($tipo) ?></td>
          </tr>
          <tr>
            <th scope="row">Zona</th>
            <td><?= $zona != '' ? htmlspecialchars($zona) : 'No indicada' ?></td>
          </tr>
          <tr>
            <th scope="row">Dirección</th>
            <td><?= $direccion != '' ? htmlspecialchars($direccion) : 'No indicada' ?></td>
          </tr>
          <tr>
            <th scope="row">Habitaciones</th>
            <td><?= $habitaciones != '' ? htmlspecialchars($habitaciones) : 'No indicadas' ?></td>
          </tr>
          <tr>
            <th scope="row">Precio</th>
            <td><?= number_format($precio, 2, ',', '.') ?> €</td>
          </tr>
          <tr>
            <th scope="row">Extras</th>
            <td>
              <?php
              if (count($extras) > 0) {
                // implode une los elementos del array con el separador que le damos
                echo htmlspecialchars(implode(', ', $extras));
              } else {
                echo 'Ninguno';
              }
              ?>
            </td>
          </tr>
          <tr>
            <th scope="row">Observaciones</th>
            <td><?= $observaciones != '' ? htmlspecialchars($observaciones) : 'Sin observaciones' ?></td>
          </tr>
        </tbody>
      </table>

      <a href="index.php" class="btn btn-primary">Insertar otra vivienda</a>

    <?php } ?>

  </main>
</body>
</html>
