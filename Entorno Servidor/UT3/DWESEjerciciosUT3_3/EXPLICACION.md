# UT3_3 · Funciones y excepciones

## De qué va

Nueve ejercicios que convierten en funciones lo que antes era código suelto, más un
`try/catch` de verdad. Todas las funciones de la relación van en un solo archivo,
`funciones.php`, y cada pestaña las usa.

## Qué pide el enunciado

| # | Ejercicio |
|---|---|
| 1 | Suma, división con variable temporal y volumen |
| 2 | `inicializar_array` y `mostrar_array` |
| 3 | `calcular_media` |
| 4 | `calcular_maximo` |
| 5 | `calcular_minimo` |
| 6 | `imprimir_array` en tabla |
| 7 | **La UT3_2 resuelta con funciones** (obligatorio) |
| 8 | **Web completa con tema claro/oscuro** (obligatorio) |
| 9 | **`try/catch` de las tres funciones** (obligatorio) |

## Paso a paso

### 1 · Las tres primeras

```php
function sumar($a, $b, $c) {
  return $a + $b + $c;
}

function dividir($a, $b) {
  $tmp = $b;          // se guarda antes de tocar nada
  if ($tmp == 0) return null;
  return $a / $tmp;
}

function volumen($radio, $altura) {
  return M_PI * $radio ** 2 * $altura;
}
```

La división comprueba el cero: dividir entre 0 en PHP 8 lanza una excepción, no
devuelve `false` como antes.

### 2 y 6 · Crear y pintar arrays

```php
function inicializar_array($n, $min, $max) {
  $datos = [];
  for ($i = 0; $i < $n; $i++) {
    $datos[] = rand($min, $max);
  }
  return $datos;
}

function mostrar_array($array) {
  echo implode(", ", $array);
}

function imprimir_array($array) {
  echo "<table>";
  foreach ($array as $valor) {
    echo "<tr><td>$valor</td></tr>";
  }
  echo "</table>";
}
```

`implode()` une los elementos con un separador. Para una tabla hay que generar las
etiquetas a mano.

### 3, 4 y 5 · Media, máximo y mínimo

```php
function calcular_media($array) {
  return array_sum($array) / count($array);
}

function calcular_maximo($array) {
  $max = $array[0];
  foreach ($array as $valor) {
    if ($valor > $max) $max = $valor;
  }
  return $max;
}
```

Se puede hacer con `max()` y `min()`, pero el ejercicio pide recorrerlo a mano: es
la forma de entender el algoritmo.

### 7 · UT3_2 con funciones (obligatorio)

Es repetir el ejercicio de arrays llamando a estas funciones en lugar de escribir
los bucles sueltos. La ventaja se ve al reutilizar: `calcular_media()` sirve aquí y
en cualquier otro sitio.

### 8 · La web con dos temas (obligatorio)

Estructura con cabecera y pie compartidos:

```php
// index.php
$tema = $_GET["tema"] ?? "claro";
include "header.php";
echo "<p>Contenido con el tema $tema</p>";
include "footer.php";
```

```php
// header.php
<link rel="stylesheet" href="css/tema<?= ucfirst($tema) ?>.css">
```

`include` mete el archivo en ese punto. Con eso la cabecera y el pie se escriben una
vez y se cambian en un solo sitio.

### 9 · `try/catch` (obligatorio)

```php
try {
  $resultado = dividir(10, 0);
  if ($resultado === null) {
    throw new Exception("No se puede dividir entre cero.");
  }
  echo $resultado;
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
} finally {
  echo "Fin de la operación.";
}
```

- `try` envuelve el código que puede fallar.
- `throw` lanza la excepción a mano cuando el error no lo detecta PHP.
- `catch` la recoge y decide qué mostrar.
- `finally` se ejecuta siempre, haya error o no.

## El código, pieza a pieza

```
DWESEjerciciosUT3_3/
├── index.php            nueve pestañas
├── ejercicios/
│   ├── funciones.php    todas las funciones de la relación
│   └── ejercicio1.php … ejercicio9.php
└── ejercicio8/          la web con los dos temas
    ├── index.php
    ├── header.php
    ├── footer.php
    └── css/temaClaro.css, temaOscuro.css
```

## Trampas y dudas

- **Dividir entre cero en PHP 8 lanza `DivisionByZeroError`.** En PHP 7 devolvía
  `false` con aviso.
- **`include` avisa si no encuentra el archivo; `require` se para.** Usa `require`
  para lo imprescindible.
- **`count()` de un array vacío y media** da división entre cero: hay que
  comprobarlo antes.
- **Una función debe devolver siempre lo mismo.** Si a veces devuelve `null` y a
  veces un número, el que la llama tiene que comprobarlo.

## Si me preguntan

- **¿Por qué pasar el array por valor?** Porque así la función no puede modificar el
  original sin querer. Si hace falta modificarlo, se pasa con `&`.
- **¿Qué diferencia hay entre `include` y `require`?** `require` detiene el script
  si falla; `include` solo avisa.
- **¿Cuándo `try/catch`?** Cuando el fallo es recuperable: entrada inválida,
  conexión caída, archivo que no existe.
