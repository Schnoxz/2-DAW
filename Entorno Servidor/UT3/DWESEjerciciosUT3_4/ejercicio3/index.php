<?php
// Ejercicio 3 (reto): formulario de alta de una vivienda en alquiler.
// También guarda la vivienda en la sesión y redirige al listado.

require 'funciones.php';

// El enlace «Empezar de nuevo» vacía el borrador y recarga el formulario limpio
if (isset($_GET['nuevo'])) {
  borrar_borrador();
  header('Location: index.php');
  exit;
}

$errores = [];

// Si se ha enviado el formulario, se valida y, si está bien, se guarda
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $datos = $_POST;
  $errores = validar_vivienda($datos);

  if (count($errores) == 0) {
    $vivienda = [
      'tipo' => $datos['tipo'],
      'zona' => $datos['zona'],
      'direccion' => trim($datos['direccion']),
      'dormitorios' => $datos['dormitorios'],
      'precio' => $datos['precio'],
      'extras' => isset($datos['extras']) ? $datos['extras'] : [],
      'foto' => foto_elegida($datos),
      'observaciones' => isset($datos['observaciones']) ? trim($datos['observaciones']) : ''
    ];

    guardar_vivienda($vivienda);
    borrar_borrador();

    // Después de guardar se va al listado: así al recargar no se duplica
    header('Location: gestionarViviendas.php?mensaje=guardada');
    exit;
  }
}

// Valores que se pintan en el formulario. El orden es: primero los datos por
// defecto, luego el borrador (si venimos de elegir foto) y, por último, lo que
// se acaba de enviar con errores, para no perder lo escrito.
$datos = [
  'tipo' => '',
  'zona' => '',
  'direccion' => '',
  'dormitorios' => '1',
  'precio' => '',
  'extras' => [],
  'foto' => '',
  'observaciones' => ''
];
if (borrador() != null) {
  $datos = array_merge($datos, borrador());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $datos = array_merge($datos, $_POST);
}

$fotos = fotos_disponibles();
$foto = foto_elegida($datos);

// Cabecera y pie cambian según la hora: par carga los archivos 1, impar los 2
$titulo = 'Nueva vivienda';
$activa = 'formulario';
if (hora_par()) {
  require 'cabecera1.php';
} else {
  require 'cabecera2.php';
}
?>

<h1 class="h3 text-primary">Nueva vivienda en alquiler</h1>
<p class="text-muted">
  Los campos marcados con * son obligatorios. Puedes elegir la foto antes de guardar.
</p>

<?php
// Si la validación ha encontrado errores, se muestran todos en una lista
if (count($errores) > 0) {
  echo "<div class='alert alert-danger'>";
  echo "<p class='mb-2'><strong>Revisa estos datos:</strong></p>";
  echo "<ul class='mb-0'>";
  foreach ($errores as $error) {
    echo '<li>' . htmlspecialchars($error) . '</li>';
  }
  echo "</ul>";
  echo "</div>";
}
?>

<form action="index.php" method="post" class="row g-3">

  <div class="col-md-4">
    <label for="tipo" class="form-label">Tipo de vivienda *</label>
    <select class="form-select" id="tipo" name="tipo">
      <option value="">Elige un tipo...</option>
      <?php
      // Recorremos los tipos y marcamos el que venga en los datos
      foreach (tipos_vivienda() as $tipo) {
        echo '<option value="' . htmlspecialchars($tipo) . '" '
          . seleccionado($datos, 'tipo', $tipo) . '>' . htmlspecialchars($tipo) . '</option>';
      }
      ?>
    </select>
  </div>

  <div class="col-md-4">
    <label for="zona" class="form-label">Zona *</label>
    <select class="form-select" id="zona" name="zona">
      <option value="">Elige una zona...</option>
      <?php
      foreach (zonas() as $zona) {
        echo '<option value="' . htmlspecialchars($zona) . '" '
          . seleccionado($datos, 'zona', $zona) . '>' . htmlspecialchars($zona) . '</option>';
      }
      ?>
    </select>
  </div>

  <div class="col-md-4">
    <label for="dormitorios" class="form-label">Número de dormitorios *</label>
    <select class="form-select" id="dormitorios" name="dormitorios">
      <?php
      // Del 1 al 4, que es lo que admite el enunciado
      for ($i = 1; $i <= 4; $i++) {
        echo '<option value="' . $i . '" ' . seleccionado($datos, 'dormitorios', $i) . '>'
          . $i . '</option>';
      }
      ?>
    </select>
  </div>

  <div class="col-md-8">
    <label for="direccion" class="form-label">Dirección *</label>
    <input type="text" class="form-control" id="direccion" name="direccion"
      value="<?= valor_campo($datos, 'direccion') ?>">
  </div>

  <div class="col-md-4">
    <label for="precio" class="form-label">Precio de alquiler (€/mes) *</label>
    <input type="number" class="form-control" id="precio" name="precio"
      step="0.01" min="0" value="<?= valor_campo($datos, 'precio') ?>">
  </div>

  <div class="col-12">
    <fieldset>
      <legend class="form-label fs-6">Extras</legend>
      <?php
      // Cada extra es una casilla independiente; el name lleva [] para que
      // PHP reciba un array con todos los extras marcados
      foreach (extras_disponibles() as $extra) {
        $id = 'extra-' . strtolower($extra);
        echo '<div class="form-check form-check-inline">';
        echo '<input class="form-check-input" type="checkbox" id="' . $id . '" '
          . 'name="extras[]" value="' . htmlspecialchars($extra) . '" '
          . marcado($datos, $extra) . '>';
        echo '<label class="form-check-label" for="' . $id . '">'
          . htmlspecialchars($extra) . '</label>';
        echo '</div>';
      }
      ?>
    </fieldset>
  </div>

  <div class="col-md-6">
    <label class="form-label d-block">Foto de la vivienda</label>
    <div class="card">
      <img src="img/<?= $foto ?>" class="card-img-top foto-miniatura"
        alt="Foto elegida: <?= htmlspecialchars($fotos[$foto]) ?>">
      <div class="card-body py-2 d-flex flex-wrap align-items-center justify-content-between gap-2">
        <span><?= htmlspecialchars($fotos[$foto]) ?></span>
        <button type="submit" class="btn btn-sm btn-outline-secondary" formaction="fotos.php">
          Elegir foto
        </button>
      </div>
    </div>
    <!-- La foto viaja con el formulario para que no se pierda al guardar -->
    <input type="hidden" name="foto" value="<?= $foto ?>">
  </div>

  <div class="col-md-6">
    <label for="observaciones" class="form-label">Observaciones</label>
    <textarea class="form-control" id="observaciones" name="observaciones"
      rows="5"><?= valor_campo($datos, 'observaciones') ?></textarea>
  </div>

  <div class="col-12">
    <button type="submit" name="accion" value="guardar" class="btn btn-primary">Guardar vivienda</button>
    <a href="index.php?nuevo=1" class="btn btn-outline-secondary">Empezar de nuevo</a>
    <a href="gestionarViviendas.php" class="btn btn-outline-primary">Ver viviendas guardadas</a>
  </div>

</form>

<?php
// El pie que toca según la misma hora que se usó para la cabecera
if (hora_par()) {
  require 'footer1.php';
} else {
  require 'footer2.php';
}
?>
