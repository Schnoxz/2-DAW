<?php
// Ejercicio 4: suma de los pares anteriores a un numero.
// Aqui va solo el formulario; el resultado lo pinta sumaPares.php, que esta en
// esta misma carpeta. El action empieza por "ejercicios/" porque es una ruta
// relativa a index.php, que es la pagina que se esta viendo.
?>
<h2 class="h4 text-primary">Ejercicio 4: suma de los pares anteriores</h2>
<p>Escribe un numero y se calculara la suma de todos los numeros pares menores que el.</p>

<!-- El numero viaja en la URL (GET) -->
<form action="ejercicios/sumaPares.php" method="get" class="row g-2 align-items-center">
  <div class="col-auto">
    <label for="numero" class="col-form-label">Numero:</label>
  </div>
  <div class="col-auto">
    <input type="number" id="numero" name="numero" min="0" class="form-control" required>
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary">Calcular</button>
  </div>
</form>

<hr>
<p class="text-secondary small">Por ejemplo, para 10 los pares anteriores son 0, 2, 4, 6 y 8, que suman 20.</p>
