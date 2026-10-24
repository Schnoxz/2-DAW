<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicio 4 - Suma de pares</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <main class="container my-5">
    <h1 class="h3 text-primary mb-4">Ejercicio 4: suma de los pares anteriores</h1>

    <?php
      // El número llega por la URL (método GET) desde el formulario de la pestaña 4. La teoría recomienda no leer $_GET directamente y filtrar: filter_input devuelve el entero, o false si el valor no es válido.
      $numero = filter_input(INPUT_GET, 'numero', FILTER_VALIDATE_INT);
      if ($numero === false || $numero === null) {
        $numero = 0;   // no han enviado el formulario o el valor no es un número
      }

      if ($numero <= 0) {
        // Aviso si el número no sirve
        echo "<div class='alert alert-warning'>No has introducido un número positivo válido.</div>";
      } else {
        // Sumo los pares anteriores al número. Empiezo en 0 y voy de dos en dos, parándome antes de llegar al número (por eso $i < $numero).
        $suma = 0;
        $pares = [];   // aquí guardo cada par para poder mostrarlos
        for ($i = 0; $i < $numero; $i += 2) {
          $suma += $i;
          $pares[] = $i;
        }

        echo "<p>Número recibido: <strong class='fs-4'>$numero</strong></p>";
        echo "<p>Números pares anteriores: " . implode(", ", $pares) . "</p>";
        echo "<div class='alert alert-success'>La suma de todos los pares anteriores a <strong>$numero</strong> es <strong class='fs-4'>$suma</strong>.</div>";
      }
    ?>

    <!-- Volvemos a la página principal: ../ porque este archivo está en una subcarpeta -->
    <a class="btn btn-secondary mt-3" href="../index.php">Volver al formulario</a>
  </main>
</body>
</html>
