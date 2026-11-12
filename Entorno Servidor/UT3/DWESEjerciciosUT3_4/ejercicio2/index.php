<?php
// Ejercicio 2 (obligatorio): formulario de alta de una vivienda.
// Los datos se envían por POST a insertarVivienda.php, que valida y resume.
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicio 2 - Alta de vivienda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/estilos.css" rel="stylesheet">
</head>
<body class="bg-light">
  <main class="container py-4">

    <h1 class="h3 text-primary">Alta de vivienda</h1>
    <p class="text-muted">
      El precio y el tipo de vivienda son obligatorios. Los demás campos son opcionales.
    </p>

    <form action="insertarVivienda.php" method="post" class="row g-3">

      <div class="col-md-4">
        <label for="tipo" class="form-label">Tipo de vivienda *</label>
        <select class="form-select" id="tipo" name="tipo">
          <option value="">Elige un tipo...</option>
          <option value="Adosado">Adosado</option>
          <option value="Unifamiliar">Unifamiliar</option>
          <option value="Piso">Piso</option>
        </select>
      </div>

      <div class="col-md-4">
        <label for="zona" class="form-label">Zona</label>
        <select class="form-select" id="zona" name="zona">
          <option value="">Elige una zona...</option>
          <option value="Centro">Centro</option>
          <option value="Norte">Norte</option>
          <option value="Sur">Sur</option>
          <option value="Este">Este</option>
          <option value="Oeste">Oeste</option>
        </select>
      </div>

      <div class="col-md-4">
        <label for="habitaciones" class="form-label">Habitaciones</label>
        <input type="number" class="form-control" id="habitaciones" name="habitaciones"
          min="1" max="10">
      </div>

      <div class="col-md-8">
        <label for="direccion" class="form-label">Dirección</label>
        <input type="text" class="form-control" id="direccion" name="direccion">
      </div>

      <div class="col-md-4">
        <label for="precio" class="form-label">Precio (€) *</label>
        <input type="number" class="form-control" id="precio" name="precio"
          step="0.01" min="0">
      </div>

      <div class="col-12">
        <fieldset>
          <legend class="form-label fs-6">Extras</legend>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="extra-garage"
              name="extras[]" value="Garage">
            <label class="form-check-label" for="extra-garage">Garage</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="extra-trastero"
              name="extras[]" value="Trastero">
            <label class="form-check-label" for="extra-trastero">Trastero</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="extra-piscina"
              name="extras[]" value="Piscina">
            <label class="form-check-label" for="extra-piscina">Piscina</label>
          </div>
        </fieldset>
      </div>

      <div class="col-12">
        <label for="observaciones" class="form-label">Observaciones</label>
        <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
      </div>

      <div class="col-12">
        <button type="submit" class="btn btn-primary">Guardar vivienda</button>
        <a href="../index.php" class="btn btn-outline-secondary">Volver al índice</a>
      </div>

    </form>
  </main>
</body>
</html>
