<?php
// Ejercicio 4: suma de los números pares anteriores a uno dado.
// En este archivo solo está el formulario. El resultado lo calcula y lo pinta
// sumaPares.php, que está en esta misma carpeta (el enunciado pide que se
// recoja "en otra página").
?>
<h2 class="h4 text-primary">Ejercicio 4: suma de los pares anteriores</h2>
<p>Escribe un número y se calculará la suma de todos los números pares menores que él.</p>

<!-- action: a qué archivo se envía. Como es una ruta relativa, se busca desde
     la carpeta de index.php (la página que se está viendo).
     method get: los datos viajan en la URL (?numero=10). -->
<form action="ejercicios/sumaPares.php" method="get" class="row g-2 align-items-center">
  <div class="col-auto">
    <label for="numero" class="col-form-label">Número:</label>
  </div>
  <div class="col-auto">
    <!-- name="numero" es la clave con la que el dato llega al otro archivo -->
    <input type="number" id="numero" name="numero" min="0" class="form-control" required>
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary">Calcular</button>
  </div>
</form>

<hr>
<p class="text-secondary small">Por ejemplo, para 10 los pares anteriores son 0, 2, 4, 6 y 8, que suman 20.</p>
