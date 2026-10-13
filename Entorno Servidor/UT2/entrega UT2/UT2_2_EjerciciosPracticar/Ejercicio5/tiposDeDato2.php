<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicio 5 - Tipos de dato (Salida 2)</title>
  <!-- CSS de Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <main class="container my-5">
    <header class="mb-4 text-center">
      <h1 class="display-6">Ejercicio 5: tipos de dato</h1>
      <p class="text-muted mb-0">Salida 2: con los valores ya cambiados</p>
    </header>

    <div class="card shadow-sm">
      <div class="card-body">
        <?php
          // SALIDA2 este archivo es una copia del anterior lo único que he hecho es cambiar el valor de las dos variables, como pide la nota "No modifiques nada del código PHP, sólo el valor de las variables"

          // Ahora numFloat vale 12, que es un número sin decimales
          $numFloat = 12;

          // is_float() sigue siendo la misma función, no he tocado nada de ella
          echo "<h2 class='h4 text-primary'>1) La variable numFloat</h2>";
          if (is_float($numFloat)) {
            echo "<p>La variable <strong>numFloat</strong> vale <strong>$numFloat</strong> y <strong>sí es float</strong>.</p>";
          } else {
            echo "<p>La variable <strong>numFloat</strong> vale <strong>$numFloat</strong> y <strong>no es float</strong>. Antes valía 5.7, que al tener decimales sí era float.</p>";
          }

          // Ahora a variableSinValor sí tiene un valor asignado
          $variableSinValor = "Ahora ya tengo un valor";

          // El is_null() es el mismo de antes, y ahora la respuesta es la contraria
          echo "<h2 class='h4 text-primary'>2) La variable variableSinValor</h2>";
          if (is_null($variableSinValor)) {
            echo "<p>La variable <strong>variableSinValor</strong> <strong>sí es NULL</strong>.</p>";
          } else {
            echo "<p>La variable <strong>variableSinValor</strong> ya no es NULL porque le he asignado el valor <strong>$variableSinValor</strong>.</p>";
          }
        ?>
        <hr>
        <p class="text-secondary small">Volver a la
          <a href="tiposDeDato.php">salida 1</a> para comparar las dos.</p>
      </div>
    </div>
  </main>
</body>
</html>
