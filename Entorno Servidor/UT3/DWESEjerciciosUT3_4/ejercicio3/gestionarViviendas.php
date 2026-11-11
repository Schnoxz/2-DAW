<?php
// Ejercicio 3: listado de viviendas con las acciones de gestión.
// Desde aquí se ordena por zona, se filtra, se modifica y se borra.

require 'funciones.php';

// --- Acciones que cambian datos ---
// Se procesan antes de escribir HTML y después se redirige, para que al
// recargar la página no se repita el borrado o la modificación.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_POST['accion']) && $_POST['accion'] == 'borrar' && isset($_POST['id'])) {
    borrar_vivienda($_POST['id']);
    header('Location: gestionarViviendas.php?mensaje=borrada');
    exit;
  }

  if (isset($_POST['accion']) && $_POST['accion'] == 'modificar' && isset($_POST['id'])) {
    $zona = isset($_POST['zona']) ? $_POST['zona'] : '';
    $precio = isset($_POST['precio']) ? trim($_POST['precio']) : '';

    // Solo se cambia si la zona es válida y el precio es un número positivo
    if (in_array($zona, zonas()) && is_numeric($precio) && $precio > 0) {
      modificar_vivienda($_POST['id'], $zona, $precio);
      header('Location: gestionarViviendas.php?mensaje=modificada');
      exit;
    }

    header('Location: gestionarViviendas.php?mensaje=error');
    exit;
  }
}

// --- Filtros y orden: llegan por GET ---
$precio_max = isset($_GET['precio_max']) ? trim($_GET['precio_max']) : '';
$dormitorios_min = isset($_GET['dormitorios_min']) ? trim($_GET['dormitorios_min']) : '';
$orden = isset($_GET['orden']) ? $_GET['orden'] : '';

$lista = viviendas();
if ($orden == 'zona') {
  $lista = ordenar_por_zona($lista);
}
if ($precio_max != '' || $dormitorios_min != '') {
  $lista = filtrar_viviendas($lista, $precio_max, $dormitorios_min);
}

// Vivienda que se está editando, si se ha pulsado «Editar» en una fila
$editar = null;
if (isset($_GET['editar'])) {
  $editar = buscar_vivienda($_GET['editar']);
}

$fotos = fotos_disponibles();

// Enlace para ordenar sin perder los filtros que haya puestos
$enlace_orden = 'gestionarViviendas.php?orden=zona';
if ($precio_max != '') {
  $enlace_orden .= '&precio_max=' . urlencode($precio_max);
}
if ($dormitorios_min != '') {
  $enlace_orden .= '&dormitorios_min=' . urlencode($dormitorios_min);
}

$titulo = 'Gestionar viviendas';
$activa = 'gestionar';
if (hora_par()) {
  require 'cabecera1.php';
} else {
  require 'cabecera2.php';
}
?>

<h1 class="h3 text-primary">Viviendas en alquiler</h1>

<?php
// Mensajes que llegan por la URL después de cada acción
if (isset($_GET['mensaje'])) {
  if ($_GET['mensaje'] == 'guardada') {
    echo "<div class='alert alert-success'>La vivienda se ha guardado correctamente.</div>";
  } elseif ($_GET['mensaje'] == 'borrada') {
    echo "<div class='alert alert-success'>La vivienda se ha eliminado del listado.</div>";
  } elseif ($_GET['mensaje'] == 'modificada') {
    echo "<div class='alert alert-success'>La zona y el precio se han modificado.</div>";
  } elseif ($_GET['mensaje'] == 'error') {
    echo "<div class='alert alert-danger'>No se han podido guardar los cambios: revisa la zona y el precio.</div>";
  }
}
?>

<!-- Filtros: precio máximo y número mínimo de dormitorios -->
<form action="gestionarViviendas.php" method="get" class="row g-2 align-items-end mb-4">
  <?php
  // Si se está ordenando por zona, el orden viaja en un campo oculto para no perderlo
  if ($orden == 'zona') {
    echo '<input type="hidden" name="orden" value="zona">';
  }
  ?>
  <div class="col-md-3">
    <label for="precio_max" class="form-label">Precio máximo (€)</label>
    <input type="number" class="form-control" id="precio_max" name="precio_max"
      step="0.01" min="0" value="<?= htmlspecialchars($precio_max) ?>">
  </div>
  <div class="col-md-3">
    <label for="dormitorios_min" class="form-label">Dormitorios mínimo</label>
    <select class="form-select" id="dormitorios_min" name="dormitorios_min">
      <option value="">Cualquiera</option>
      <?php
      for ($i = 1; $i <= 4; $i++) {
        echo '<option value="' . $i . '" ' . seleccionado(['dormitorios_min' => $dormitorios_min], 'dormitorios_min', $i)
          . '>' . $i . '</option>';
      }
      ?>
    </select>
  </div>
  <div class="col-md-6">
    <button type="submit" class="btn btn-primary">Filtrar</button>
    <a href="gestionarViviendas.php" class="btn btn-outline-secondary">Quitar filtros</a>
    <a href="<?= $enlace_orden ?>" class="btn btn-outline-primary">Ordenar por zona</a>
  </div>
</form>

<?php
// Formulario de modificación: solo aparece al pulsar «Editar» en una fila
if ($editar != null) {
  ?>
  <form action="gestionarViviendas.php" method="post" class="card card-body mb-4">
    <h2 class="h5">Modificar la vivienda #<?= $editar['id'] ?></h2>
    <input type="hidden" name="accion" value="modificar">
    <input type="hidden" name="id" value="<?= $editar['id'] ?>">

    <div class="row g-3">
      <div class="col-md-4">
        <label for="zona_editar" class="form-label">Zona</label>
        <select class="form-select" id="zona_editar" name="zona">
          <?php
          foreach (zonas() as $zona) {
            echo '<option value="' . htmlspecialchars($zona) . '" '
              . seleccionado($editar, 'zona', $zona) . '>' . htmlspecialchars($zona) . '</option>';
          }
          ?>
        </select>
      </div>
      <div class="col-md-4">
        <label for="precio_editar" class="form-label">Precio (€/mes)</label>
        <input type="number" class="form-control" id="precio_editar" name="precio"
          step="0.01" min="0" value="<?= htmlspecialchars($editar['precio']) ?>">
      </div>
      <div class="col-md-4 d-flex align-items-end gap-2">
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <a href="gestionarViviendas.php" class="btn btn-outline-secondary">Cancelar</a>
      </div>
    </div>
  </form>
  <?php
}
?>

<?php if (count($lista) == 0) { ?>

  <div class="alert alert-info">
    No hay viviendas que mostrar.
    <a href="index.php" class="alert-link">Dar de alta una vivienda</a>.
  </div>

<?php } else { ?>

  <p class="text-muted"><?= count($lista) ?> vivienda(s) en el listado.</p>

  <div class="table-responsive">
    <table class="table table-striped align-middle bg-white">
      <caption class="visually-hidden">Listado de viviendas en alquiler</caption>
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Tipo</th>
          <th scope="col">Zona</th>
          <th scope="col">Dirección</th>
          <th scope="col">Dorm.</th>
          <th scope="col">Precio</th>
          <th scope="col">Extras</th>
          <th scope="col">Foto</th>
          <th scope="col">Observaciones</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($lista as $vivienda) {
          echo '<tr>';
          echo '<td>' . $vivienda['id'] . '</td>';
          echo '<td>' . htmlspecialchars($vivienda['tipo']) . '</td>';
          echo '<td>' . htmlspecialchars($vivienda['zona']) . '</td>';
          echo '<td>' . htmlspecialchars($vivienda['direccion']) . '</td>';
          echo '<td>' . htmlspecialchars($vivienda['dormitorios']) . '</td>';
          echo '<td>' . formatear_precio($vivienda['precio']) . '</td>';

          // Los extras se guardaron como array: aquí se unen con comas
          if (count($vivienda['extras']) > 0) {
            echo '<td>' . htmlspecialchars(implode(', ', $vivienda['extras'])) . '</td>';
          } else {
            echo '<td>Ninguno</td>';
          }

          $descripcion_foto = isset($fotos[$vivienda['foto']]) ? $fotos[$vivienda['foto']] : 'Foto';
          echo '<td><img src="img/' . $vivienda['foto'] . '" class="foto-tabla" alt="'
            . htmlspecialchars($descripcion_foto) . '"></td>';

          if ($vivienda['observaciones'] != '') {
            echo '<td class="small">' . htmlspecialchars($vivienda['observaciones']) . '</td>';
          } else {
            echo '<td class="small text-muted">Sin observaciones</td>';
          }

          echo '<td>';
          echo '<a href="gestionarViviendas.php?editar=' . $vivienda['id']
            . '" class="btn btn-sm btn-outline-primary mb-1">Editar</a> ';

          // El borrado va en un formulario para que no se pueda hacer con un enlace
          echo '<form action="gestionarViviendas.php" method="post" class="d-inline">';
          echo '<input type="hidden" name="accion" value="borrar">';
          echo '<input type="hidden" name="id" value="' . $vivienda['id'] . '">';
          echo '<button type="submit" class="btn btn-sm btn-outline-danger mb-1">Borrar</button>';
          echo '</form>';
          echo '</td>';

          echo '</tr>';
        }
        ?>
      </tbody>
    </table>
  </div>

<?php } ?>

<a href="index.php" class="btn btn-primary mt-3">Dar de alta otra vivienda</a>

<?php
if (hora_par()) {
  require 'footer1.php';
} else {
  require 'footer2.php';
}
?>
