<?php
// Ejercicio 9 (OBLIGATORIO): las tres funciones lanzan una excepción cuando los
// datos no son válidos, y con try/catch enseñamos el mensaje en vez de romper
// la página.

echo "<h2 class='h4 text-primary'>Ejercicio 9: funciones con excepciones (obligatorio)</h2>";

// ------------------------------ sumar() ------------------------------
echo "<h3 class='h6 mt-3'>sumar()</h3>";

// Caso correcto: dos números
try {
  echo "<p>sumar(4, 6) = <strong>" . sumar(4, 6) . "</strong></p>";
} catch (Exception $e) {
  echo "<p class='text-danger'>sumar(4, 6) -> " . $e->getMessage() . "</p>";
}

// Caso incorrecto: el segundo valor es una cadena que no es un número
try {
  echo "<p>sumar(4, 'hola') = <strong>" . sumar(4, "hola") . "</strong></p>";
} catch (Exception $e) {
  echo "<p class='text-danger'>sumar(4, 'hola') -> " . $e->getMessage() . "</p>";
}

// ----------------------------- dividir() -----------------------------
echo "<h3 class='h6 mt-3'>dividir()</h3>";

try {
  echo "<p>dividir(10, 4) = <strong>" . dividir(10, 4) . "</strong></p>";
} catch (Exception $e) {
  echo "<p class='text-danger'>dividir(10, 4) -> " . $e->getMessage() . "</p>";
}

// El cero es numérico, así que lo tiene que controlar la propia función
try {
  echo "<p>dividir(10, 0) = <strong>" . dividir(10, 0) . "</strong></p>";
} catch (Exception $e) {
  echo "<p class='text-danger'>dividir(10, 0) -> " . $e->getMessage() . "</p>";
}

// ---------------------- calcularAreaTriangulo() ----------------------
echo "<h3 class='h6 mt-3'>calcularAreaTriangulo()</h3>";

try {
  echo "<p>calcularAreaTriangulo(6, 4) = <strong>" . calcularAreaTriangulo(6, 4) . "</strong></p>";
} catch (Exception $e) {
  echo "<p class='text-danger'>calcularAreaTriangulo(6, 4) -> " . $e->getMessage() . "</p>";
}

// Una medida negativa no describe un triángulo, aunque sea un número
try {
  echo "<p>calcularAreaTriangulo(-6, 4) = <strong>" . calcularAreaTriangulo(-6, 4) . "</strong></p>";
} catch (Exception $e) {
  echo "<p class='text-danger'>calcularAreaTriangulo(-6, 4) -> " . $e->getMessage() . "</p>";
}
