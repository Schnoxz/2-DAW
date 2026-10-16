<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicio 4 - Suma de pares</title>
  <!-- Bootstrap 5, igual que en index.php -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <main class="container my-5" style="max-width: 640px;">
    <h1 class="h3 text-primary mb-4">Ejercicio 4: suma de los pares anteriores</h1>

    <?php
      // El numero llega del formulario de la pestaña 4, en la URL (metodo GET).
      // Con ?? 0 no da error si alguien abre esta pagina sin pasar por el formulario.
      $numero = intval($_GET['numero'] ?? 0);

      if ($numero <= 0) {
        echo "<div class='alert alert-warning'>No has introducido un numero positivo valido.</div>";
      } else {
        // Voy de dos en dos desde el 0, y solo hasta el anterior al numero: el
        // enunciado pide los pares ANTERIORES.
        $suma = 0;
        $pares = [];  // los guardo tambien para poder mostrarlos luego
        for ($i = 0; $i < $numero; $i += 2) {
          $suma += $i;
          $pares[] = $i;
        }

        echo "<p>Numero recibido: <strong class='fs-4'>$numero</strong></p>";
        echo "<p>Numeros pares anteriores: " . implode(", ", $pares) . "</p>";
        echo "<div class='alert alert-success'>La suma de todos los pares anteriores a <strong>$numero</strong> es <strong class='fs-4'>$suma</strong>.</div>";
      }
    ?>

    <!-- Vuelvo a index.php: ../ porque este archivo esta dentro de la subcarpeta -->
    <a class="btn btn-secondary mt-3" href="../index.php">Volver al formulario</a>
  </main>
</body>
</html>
