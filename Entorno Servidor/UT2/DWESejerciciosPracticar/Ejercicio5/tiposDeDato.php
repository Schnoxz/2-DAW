<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicio 5 - Tipos de dato (Salida 1)</title>
  <!-- CSS de Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <main class="container my-5">
    <header class="mb-4 text-center">
      <h1 class="display-6">Ejercicio 5: tipos de dato</h1>
      <p class="text-muted mb-0">Salida 1: con los valores que da el enunciado</p>
    </header>

    <div class="card shadow-sm">
      <div class="card-body">
        <?php
          // SALIDA 1
          // These are the original values from the statement, nothing has been changed yet

          // 1) A variable called "numFloat" of type float
          // The number 5.7 has a decimal part, so PHP stores it as a float on its own
          $numFloat = 5.7;

          // is_float() returns TRUE if the variable is of type float
          // The if asks if that is the case, and if so it shows one message and if not another
          echo "<h2 class='h4 text-primary'>1) La variable numFloat</h2>";
          if (is_float($numFloat)) {
            echo "<p>La variable <strong>numFloat</strong> vale <strong>$numFloat</strong> y <strong>sí es float</strong>.</p>";
          } else {
            echo "<p>La variable <strong>numFloat</strong> vale <strong>$numFloat</strong> y <strong>no es float</strong>.</p>";
          }

          // 2) A variable called "variableSinValor" with no value assigned
          // null es el valor que tiene por dentro una variable creada sin valor.
          // Se lo pongo aquí escrito para que is_null() no avise de que la variable no existe
          $variableSinValor = null;

          // is_null() returns TRUE when the variable is NULL, which is what an empty variable is
          echo "<h2 class='h4 text-primary'>2) La variable variableSinValor</h2>";
          if (is_null($variableSinValor)) {
            echo "<p>La variable <strong>variableSinValor</strong> <strong>sí es NULL</strong>, porque se creó pero no se le dio ningún valor.</p>";
          } else {
            echo "<p>La variable <strong>variableSinValor</strong> <strong>no es NULL</strong>.</p>";
          }
        ?>
        <hr>
        <p class="text-secondary small">Para ver la salida 2 hay que abrir
          <a href="tiposDeDato2.php">tiposDeDato2.php</a>, que tiene el mismo código con los
          valores ya cambiados.</p>
      </div>
    </div>
  </main>
</body>
</html>
