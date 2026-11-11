<?php
// Ejercicio 1 (opcional): formulario que recoge los datos de una persona.
// No lleva el atributo required a propósito: la comprobación la hace PHP en
// salario.php, que es lo que pide el enunciado.
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicio 1 - Cálculo del salario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/estilos.css" rel="stylesheet">
</head>
<body class="bg-light">
  <main class="container py-4">

    <h1 class="h3 text-primary">Cálculo del salario</h1>
    <p class="text-muted">Rellena los cuatro datos y pulsa «Calcular salario».</p>

    <?php
    // salario.php redirige aquí con ?error=1 cuando falta algún dato.
    // El error viaja por GET, tal y como pide el enunciado.
    if (isset($_GET['error'])) {
      echo "<div class='alert alert-danger'>";
      echo "<strong>FALTAN DATOS</strong>: no se ha rellenado alguno de los campos.";
      echo " <a href='index.php' class='alert-link'>Volver al formulario</a>";
      echo "</div>";
    }
    ?>

    <form action="salario.php" method="post" class="row g-3">

      <div class="col-md-6">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre">
      </div>

      <div class="col-md-6">
        <label for="apellidos" class="form-label">Apellidos</label>
        <input type="text" class="form-control" id="apellidos" name="apellidos">
      </div>

      <div class="col-md-6">
        <label for="salario" class="form-label">Salario (€)</label>
        <input type="number" class="form-control" id="salario" name="salario"
          step="0.01" min="0">
      </div>

      <div class="col-md-6">
        <label for="edad" class="form-label">Edad</label>
        <input type="number" class="form-control" id="edad" name="edad" min="0">
      </div>

      <div class="col-12">
        <button type="submit" class="btn btn-primary">Calcular salario</button>
        <a href="../index.php" class="btn btn-outline-secondary">Volver al índice</a>
      </div>

    </form>
  </main>
</body>
</html>
