<?php
// Ejercicio 3: galería para elegir la foto de la vivienda.
// Recibe el formulario por POST, lo guarda como borrador y vuelve a index.php
// con la foto elegida, sin perder los datos que ya estaban escritos.

require 'funciones.php';

// Al pulsar «Elegir foto» en el formulario, los datos llegan aquí por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  guardar_borrador($_POST);
}

// Al pulsar una foto, se apunta en el borrador y se vuelve al formulario
if (isset($_GET['foto'])) {
  $fotos = fotos_disponibles();
  if (isset($fotos[$_GET['foto']])) {
    $datos_borrador = borrador();
    if ($datos_borrador == null) {
      $datos_borrador = [];
    }
    $datos_borrador['foto'] = $_GET['foto'];
    guardar_borrador($datos_borrador);
  }
  header('Location: index.php');
  exit;
}

$datos = borrador();
if ($datos == null) {
  $datos = [];
}

$fotos = fotos_disponibles();
$foto_actual = foto_elegida($datos);

// Cabecera y pie según la hora, igual que en el resto de páginas
$titulo = 'Elegir foto';
$activa = 'fotos';
if (hora_par()) {
  require 'cabecera1.php';
} else {
  require 'cabecera2.php';
}
?>

<h1 class="h3 text-primary">Elige la foto de la vivienda</h1>
<p class="text-muted">
  Pulsa «Elegir esta foto» y volverás al formulario con todos los datos que ya
  habías escrito.
</p>

<div class="row g-3">
  <?php
  // Recorremos el array de fotos: la clave es el archivo y el valor, su nombre
  foreach ($fotos as $archivo => $descripcion) {
    echo '<div class="col-md-4">';
    echo '<div class="card h-100">';
    echo '<img src="img/' . $archivo . '" class="card-img-top foto-miniatura" alt="'
      . htmlspecialchars($descripcion) . '">';
    echo '<div class="card-body d-flex flex-column">';
    echo '<p class="card-title mb-2">' . htmlspecialchars($descripcion) . '</p>';

    // La foto que ya está elegida se marca con una etiqueta verde
    if ($archivo == $foto_actual) {
      echo '<span class="badge bg-success mb-2">Elegida</span>';
    }

    echo '<a href="fotos.php?foto=' . urlencode($archivo)
      . '" class="btn btn-sm btn-primary mt-auto">Elegir esta foto</a>';
    echo '</div></div></div>';
  }
  ?>
</div>

<a href="index.php" class="btn btn-outline-secondary mt-4">Volver sin cambiar la foto</a>

<?php
if (hora_par()) {
  require 'footer1.php';
} else {
  require 'footer2.php';
}
?>
