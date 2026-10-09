<?php
// ================= EJERCICIO 4 (opcional): suma de pares =================
// Trozo de pagina que index.php incluye dentro de la pestaña del ejercicio 4.
//
// OJO: este ejercicio necesita DOS paginas, asi que aqui solo va el formulario.
// El resultado lo muestra sumaPares.php, que esta en esta misma subcarpeta.
// El action es relativo a index.php (la pagina que se ve), por eso empieza por
// "ejercicios/".
?>
<h2 class="h4 text-primary">Ejercicio 4: suma de los pares anteriores</h2>
<p>Escribe un numero y se calculara la suma de todos los numeros pares menores que el.</p>

<!-- El formulario envia el numero a la otra pagina (sumaPares.php).
     method="get" hace que el numero viaje en la URL. -->
<form action="ejercicios/sumaPares.php" method="get" class="row g-2 align-items-center">
  <div class="col-auto">
    <label for="numero" class="col-form-label">Numero:</label>
  </div>
  <div class="col-auto">
    <!-- type="number" con min="0" obliga a que sea un numero positivo (o cero) -->
    <input type="number" id="numero" name="numero" min="0" class="form-control" required>
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary">Calcular</button>
  </div>
</form>

<hr>
<p class="text-secondary small">Por ejemplo, para 10 los pares anteriores son 0, 2, 4, 6 y 8, que suman 20.</p>
