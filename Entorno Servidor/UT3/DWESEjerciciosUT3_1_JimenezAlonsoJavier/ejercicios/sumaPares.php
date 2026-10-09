<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicio 4 - Suma de pares</title>
  <!-- Estilos de Bootstrap 5 desde el CDN, igual que en index.php -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <main class="container my-5" style="max-width: 640px;">
    <h1 class="h3 text-primary mb-4">Ejercicio 4: suma de los pares anteriores</h1>

    <?php
      // El numero llega desde el formulario (que esta en la pestaña 4 de index.php)
      // por la URL (metodo GET), asi que lo leo de la variable $_GET.
      // El operador ?? significa "si viene, usalo; si no, usa 0", para que no de error
      // si alguien abre esta pagina directamente sin pasar por el formulario.
      $numero = intval($_GET['numero'] ?? 0);

      // Compruebo que el numero sea valido (positivo o cero)
      if ($numero <= 0) {
        echo "<div class='alert alert-warning'>No has introducido un numero positivo valido.</div>";
      } else {
        // Recorro los numeros desde 0 hasta el anterior al introducido.
        // Empiezo en 0 y voy de 2 en 2 ($i += 2), asi solo paso por los pares.
        // La condicion es $i menor que $numero porque el enunciado pide los ANTERIORES a el.
        $suma = 0;
        $pares = [];  // Guardo los pares para poder mostrarlos en pantalla
        for ($i = 0; $i < $numero; $i += 2) {
          $suma += $i;      // Voy acumulando la suma
          $pares[] = $i;    // Y guardo cada par en el array
        }

        echo "<p>Numero recibido: <strong class='fs-4'>$numero</strong></p>";
        // implode() junta los elementos del array en un solo texto separados por ", "
        echo "<p>Numeros pares anteriores: " . implode(", ", $pares) . "</p>";
        echo "<div class='alert alert-success'>La suma de todos los pares anteriores a <strong>$numero</strong> es <strong class='fs-4'>$suma</strong>.</div>";
      }
    ?>

    <!-- Link para volver al formulario (que esta en la pestaña 4 de index.php).
         Como este archivo esta dentro de la subcarpeta, subo un nivel con "../" -->
    <a class="btn btn-secondary mt-3" href="../index.php">Volver al formulario</a>
  </main>
</body>
</html>
