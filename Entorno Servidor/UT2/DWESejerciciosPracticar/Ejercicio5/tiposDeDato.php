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
          
          // Declaro numFloat especificamente con valor float para la parte 1 del ejercicio
          $numFloat = 5.7;

          // Comprueba si es float el valor dentro de la variable declarada con un if, si no lo es pasa por el else e imprime el mensaje contrario
          echo "<h2 class='h4 text-primary'>1) La variable numFloat</h2>";
          if (is_float($numFloat)) {
            echo "<p>La variable <strong>numFloat</strong> vale <strong>$numFloat</strong> y <strong>sí es float</strong>.</p>";
          } else {
            echo "<p>La variable <strong>numFloat</strong> vale <strong>$numFloat</strong> y <strong>no es float</strong>.</p>";
          }
        
          // null es el valor que tiene por dentro una variable creada sin valor.
          // Se lo pongo aquí escrito para que is_null() no avise de que la variable no existe
          $variableSinValor = null;

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
