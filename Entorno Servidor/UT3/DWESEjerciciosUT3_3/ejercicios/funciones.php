<?php
// Funciones de la relación UT3_3. Se cargan una sola vez desde index.php,
// así los ejercicios pueden usarlas sin volver a definirlas.

// ---------------------------- Ejercicio 1 ----------------------------

// sumarCinco($num1, $num2, $num3, $num4, $num5)
// Suma los cinco números y muestra el resultado en la página.
// No devuelve nada: el resultado se escribe directamente.
function sumarCinco($num1, $num2, $num3, $num4, $num5)
{
  $suma = $num1 + $num2 + $num3 + $num4 + $num5;
  echo "<p>La suma de $num1 + $num2 + $num3 + $num4 + $num5 es <strong>$suma</strong>.</p>";
}

// dividirDosDeCinco($num1, $num2, $num3, $num4, $num5)
// Divide el primero entre el segundo; los otros tres se piden porque el
// enunciado obliga a recibir cinco parámetros, aunque no se usen.
// Devuelve el cociente. Lanza una excepción si el divisor es 0.
function dividirDosDeCinco($num1, $num2, $num3, $num4, $num5)
{
  if ($num2 == 0) {
    throw new Exception("No se puede dividir entre cero");
  }
  return $num1 / $num2;
}

// volumenCilindro($radio, $altura)
// Los dos parámetros van en la misma unidad de longitud.
// Devuelve el volumen del cilindro.
function volumenCilindro($radio, $altura)
{
  // 3.1416 es la aproximación de pi que da el enunciado
  $pi = 3.1416;
  return $pi * $radio * $radio * $altura;
}

// ---------------------------- Ejercicio 2 ----------------------------

// inicializar_array($numero_de_elementos, $min, $max)
// Crea un array de enteros al azar entre $min y $max, ambos incluidos.
// Devuelve el array ya relleno.
function inicializar_array($numero_de_elementos, $min, $max)
{
  $datos = [];
  for ($i = 0; $i < $numero_de_elementos; $i++) {
    $datos[] = rand($min, $max);
  }
  return $datos;
}

// mostrar_array($datos, $titulo = '')
// Pinta los valores del array como etiquetas. El título es opcional.
// No devuelve nada: escribe en la página.
function mostrar_array($datos, $titulo = '')
{
  if ($titulo != '') {
    echo "<p class='fw-semibold mb-1'>$titulo</p>";
  }

  // d-flex + flex-wrap: las etiquetas van en fila y bajan de línea si no caben
  echo "<div class='d-flex flex-wrap gap-2 mb-3'>";
  foreach ($datos as $valor) {
    echo "<span class='badge text-bg-secondary fs-6'>$valor</span>";
  }
  echo "</div>";
}

// ------------------------ Ejercicios 3, 4 y 5 ------------------------

// calcular_media($datos)
// $datos es un array de números.
// Devuelve la media aritmética.
function calcular_media($datos)
{
  // array_sum suma todos los elementos y count cuenta cuántos hay
  return array_sum($datos) / count($datos);
}

// calcular_maximo($datos)
// $datos es un array de números.
// Devuelve el valor más alto.
function calcular_maximo($datos)
{
  // Arranco con el primero en vez de con 0 para que funcione también con negativos
  $maximo = $datos[0];
  foreach ($datos as $valor) {
    if ($valor > $maximo) {
      $maximo = $valor;
    }
  }
  return $maximo;
}

// calcular_minimo($datos)
// $datos es un array de números.
// Devuelve el valor más bajo.
function calcular_minimo($datos)
{
  $minimo = $datos[0];
  foreach ($datos as $valor) {
    if ($valor < $minimo) {
      $minimo = $valor;
    }
  }
  return $minimo;
}

// ---------------------------- Ejercicio 6 ----------------------------

// imprimir_array($datos)
// Pinta el array en una tabla de dos columnas: posición y valor.
// No devuelve nada: escribe en la página.
function imprimir_array($datos)
{
  echo "<div class='table-responsive'>";
  echo "<table class='table table-bordered table-sm align-middle mb-3'>";
  echo "<thead class='table-primary'><tr>";
  echo "<th scope='col'>Posición</th><th scope='col'>Valor</th>";
  echo "</tr></thead>";
  echo "<tbody>";
  // En el foreach, la clave es la posición que ocupa el elemento en el array
  foreach ($datos as $posicion => $valor) {
    echo "<tr><th scope='row'>$posicion</th><td>$valor</td></tr>";
  }
  echo "</tbody>";
  echo "</table>";
  echo "</div>";
}

// ---------------------------- Ejercicio 7 ----------------------------

// tresMayores($datos)
// $datos es un array de números.
// Devuelve los tres valores más altos, de mayor a menor.
function tresMayores($datos)
{
  // Copio antes de ordenar: rsort() modifica el array que recibe y aquí
  // hace falta conservar el original para poder calcular los mínimos
  $copia = $datos;
  rsort($copia);
  // array_slice() se queda con los tres primeros de la copia ordenada
  return array_slice($copia, 0, 3);
}

// tresMenores($datos)
// $datos es un array de números.
// Devuelve los tres valores más bajos, de menor a mayor.
function tresMenores($datos)
{
  $copia = $datos;
  sort($copia);
  return array_slice($copia, 0, 3);
}

// ---------------------------- Ejercicio 9 ----------------------------

// sumar($num1, $num2)
// Devuelve la suma de los dos valores.
// Lanza una excepción si alguno no es un número.
function sumar($num1, $num2)
{
  // is_numeric() acepta enteros, decimales y cadenas que parezcan números
  if (!is_numeric($num1) || !is_numeric($num2)) {
    throw new Exception("Los valores a sumar tienen que ser numéricos");
  }
  return $num1 + $num2;
}

// dividir($dividendo, $divisor)
// Devuelve el cociente de la división.
// Lanza una excepción si algún valor no es numérico o si el divisor es 0.
function dividir($dividendo, $divisor)
{
  if (!is_numeric($dividendo) || !is_numeric($divisor)) {
    throw new Exception("Los valores a dividir tienen que ser numéricos");
  }
  // El cero sí es un número, así que hay que comprobarlo aparte
  if ($divisor == 0) {
    throw new Exception("El divisor no puede ser cero");
  }
  return $dividendo / $divisor;
}

// calcularAreaTriangulo($base, $altura)
// Devuelve el área del triángulo.
// Lanza una excepción si algún valor no es numérico o no es positivo.
function calcularAreaTriangulo($base, $altura)
{
  if (!is_numeric($base) || !is_numeric($altura)) {
    throw new Exception("La base y la altura tienen que ser numéricas");
  }
  // Una medida negativa o cero no describe un triángulo real
  if ($base <= 0 || $altura <= 0) {
    throw new Exception("La base y la altura tienen que ser positivas");
  }
  return ($base * $altura) / 2;
}
